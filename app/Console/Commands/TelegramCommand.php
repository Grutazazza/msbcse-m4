<?php

namespace App\Console\Commands;

use App\Models\TelegramSetting;
use App\Models\TelegramCommand as ModelTelegramCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramCommand extends Command
{
    const TELEGRAM_ADDR = 'https://api.telegram.org/bot';
    protected $offsetId = 0;
    /**
     * The name and signature of the console command.
     *Создаём команду для консоли
     * Для вызова бота вызываем команду
     * php artisan command:telegram --setCommand
     * @var string
     */
    protected $signature = 'command:telegram {--setCommands}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram get and send messages. And set commands';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getSetting = TelegramSetting::where('name','key')->first();

        if (!$getSetting)
            return $this->output->error("Ошибка выполнения программы!\nСоздайте настройку key с ключём от бота");

        if ($this->option('setCommands')){
            $commands = ModelTelegramCommand::all()->ToArray();
            if (!$commands) return  $this->output->warning('Нет команд');
            $setCommands = [];
            foreach ($commands as $command){
                $setCommands[]=['command'=>$command['command'],'description'=>'none'];
            }

            $this->output->success(json_encode(['commands'=>$setCommands]));
            Http::post(self::TELEGRAM_ADDR.$getSetting['val'].'/setMyCommands',['commands'=>$setCommands])->header('Content-Type: application/json');

            return $this->output->success('Успешно установленны данные команд');
        }

        $getAllNewMessages = $this->getUpdates($getSetting['val']);
        if ($getAllNewMessages['status']>210)
            return $this->output->error("ошибка выполнения программы!\n запрос выполнен успешно");

        $sendmessage = [];
        foreach ($getAllNewMessages['body']['result'] as $message)
            $sendmessage[] = $this->parsingMessage($message);

        #Массив без пустых элементов
        $sendmessage = array_filter($sendmessage, function ($item){
            return $item !=[];
        });

        if ($sendmessage ==[])
            return $this->output->success('Нет сообщений для отправки, программа завершена!');

        $this->sendMessage($getSetting['val'],$sendmessage);
        $this->setOffsetId($getSetting['val']);

        return Command::SUCCESS;
    }

    private function getUpdates($key)
    {
        $response = Http::get(self::TELEGRAM_ADDR.$key.'/getUpdates');
        return ['status'=>$response->status(),'body'=>$response->json()];
    }

    private function parsingMessage($message){
        #Получаем идентификатор чата пользователя
        $idUser=$message['message']['from']['id'];

        $this->offsetId=$this->offsetId<$message['message']?$message['update_id']:$this->offsetId;

        #Получаем текст который прислал пользователь
        $command = $message['message']['text'];

        #Узнаем является данный текст командой
        if (!isset($message['message']['entities'])) return[];

        #Вырезаем команду
        $commands=[];
        foreach ($message['message']['entities'] as $item)
            $commands[] = mb_substr($command, $item['offset'],$item['length']);

        #Получаеи все команды из нашего списка
        $commands = ModelTelegramCommand::whereIn('command',$commands)->get()->toArray();

        #Если нет такой команды ответа не будет
        if ($commands==[]) return[];
        $textContent = '';
        foreach ($commands as $item)
            $textContent .= $item['context'] ;

        return ['chat_id'=>$idUser,'text'=>$textContent];

    }
    private function sendMessage($key,$messages){

        foreach ($messages as $item){
            Http::post(self::TELEGRAM_ADDR.$key.'/sendMessage',$item)->header('Content-Type: application/json');
            usleep(300);
        }
    }

    private  function setOffsetId($key){
        Http::post(self::TELEGRAM_ADDR.$key.'/getUpdates',['offset'=>$this->offsetId++]);
    }
}

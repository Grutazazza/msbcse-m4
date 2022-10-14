<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditParametrsValidationRequest;
use App\Http\Requests\ParametrsValidationRequest;
use App\Models\TelegramSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use voku\helper\ASCII;
use function Couchbase\basicDecoderV1;

class TelegramSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *переход на страницу с настройками телеграма
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $telegramSetting = TelegramSetting::all();
        return view('telegramSetting.index',compact('telegramSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *Переход на страницу создания телеграма
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('telegramSetting.create');
    }

    /**
     * Store a newly created resource in storage.
     *Добавление новой настройки
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(ParametrsValidationRequest $request)
    {
        TelegramSetting::create($request->validated());
        return redirect()->route('telegram-setting.index')->with(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *Пока не используется будет возвращать назад
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function show(TelegramSetting $telegramSetting)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *Переход на страницу редактирования настройки
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(TelegramSetting $telegramSetting)
    {
        return view('telegramSetting.edit',compact('telegramSetting'));

    }

    /**
     * Update the specified resource in storage.
     *Изменение данных настройки-
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(EditParametrsValidationRequest $request, TelegramSetting $telegramSetting)
    {
        $telegramSetting->update($request->validated());
        return back()->with(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *Удаление настройки
     * @param  \App\Models\TelegramSetting  $telegramSetting
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(TelegramSetting $telegramSetting)
    {
        $telegramSetting->delete();
        return back()->with(['successDelete'=>true]);
    }
}

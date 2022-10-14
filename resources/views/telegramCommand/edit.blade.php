@extends('welcome')
@section('title','Редактирование команд'){{--Это тайтл--}}
@section('content'){{--Это секция что будет вставлена в welcome--}}
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-12 col-md-6">
            <a href="{{route('telegram-command.index')}}" class="text-secondary">Вернуться на список команд</a>
            <h2>Редактирование команды {{$command->command}}</h2>
            @if(session()->has('success'))
                <div class="alert alert-success">Ваша настройка успешно отредактированна.</div>
            @endif
            <form action="{{route('telegram-command.update',$command->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('components.input',[
                                                'input'=>[
                                                    'name'=>'command',
                                                    'label'=>'Введите название команды по примеру: /start',
                                                    'default'=>$command->command,
                                                    ]
                                             ])
                @include('components.input',[
                                                'input'=>[
                                                    'name'=>'context',
                                                    'label'=>'Введите текст который будет отображаться у пользователя',
                                                    'default'=>$command->context,
                                                    ]
                                             ])
                <input type="submit" class="btn btn-primary" value="Сохранить команду">
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection

@extends('welcome')
@section('title','Создание команд'){{--Это тайтл--}}
@section('content'){{--Это секция что будет вставлена в welcome--}}
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-12 col-md-6">
            <a href="{{route('telegram-command.index')}}" class="text-secondary">Вернуться на список команд</a>
            <h2>Создание новой команды</h2>
            @if(session()->has('success'))
                <div class="alert alert-success">Ваша настройка успешно созданна, можете создать новую.</div>
            @endif
            <form action="{{route('telegram-command.store')}}" method="POST">
                @csrf
                @include('components.input',[
                                                'input'=>[
                                                    'name'=>'command',
                                                    'label'=>'Введите название команды по примеру: /start'
                                                    ]
                                             ])
                @include('components.input',[
                                                'input'=>[
                                                    'name'=>'context',
                                                    'label'=>'Введите текст который будет отображаться у пользователя'
                                                    ]
                                             ])
                <input type="submit" class="btn btn-primary" value="Создать новую команду">
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection

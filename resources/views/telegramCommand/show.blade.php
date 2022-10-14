@extends('welcome')
@section('title','Просмотр единичной записи команды'){{--Это тайтл--}}
@section('content'){{--Это секция что будет вставлена в welcome--}}
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-12 col-md-6">
            <h2>Команда {{$command->comand}}</h2>
            <label class="text-secondary small">Контекст команды</label>
            <p>{{$command->context}}</p>
            <a href="{{route('telegram-command.index')}}" class="btn btn-sm btn-secondary">Возврат</a>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection

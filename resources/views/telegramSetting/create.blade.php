@extends('welcome')

@section('title', 'создание настроек') {{--Это тайтл--}}
@section('content'){{--Это секция что будет вставлена в welcome--}}
    <div class="container mt-2">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <h2>Создание настроек</h2>
                <p>В данном разделе вы можете задать основные настройки управления вашего приложения.</p>
                <form action="{{route('telegram-setting.store')}}" method="POST">
                    @csrf
                    @include('components.input',['input'=>['name'=>'name','label'=>'Введите название настройки, на английском']])
                    @include('components.input',['input'=>['name'=>'val','label'=>'Введите значение данной настройки']])
                    <input type="submit" value="Создать новый параметр" class="btn btn-sm btn-primary">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

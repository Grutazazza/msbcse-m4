@extends('welcome')
@section('title','Страница настройки телеграмма'){{--Это тайтл--}}
@section('content'){{--Это секция что будет вставлена в welcome--}}
    <div class="container mt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                @if(session()->has('success'))
                    <div class="alert alert-success mt-3 mb-3">Новый параметр успешно сосздан</div>
                @endif
                @if(session()->has('successDelete'))
                    <div class="alert alert-warning mt-3 mb-3">Элемент успешно удалён</div>
                @endif
                    <a href="{{route('telegram-setting.create')}}" class="btn btn-sm btn-success">Создать новый параметр</a>
                <table class="table">
                    <tr>
                        <th>Название параметра</th>
                        <th>Название параметра</th>
                        <th>функционал</th>
                    </tr>
                    @each('telegramSetting.row',$telegramSetting,'setting','telegramSetting.rowEmpty')
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
    @include('components.destroy_modal',['nameRoute'=>'telegram-setting.index'])
@endsection

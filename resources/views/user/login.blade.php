@extends('welcome')
@section('title','авторизация'){{--Это тайтл--}}
@section('content'){{--Это секция что будет вставлена в welcome--}}
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-6 col-12">
                @if(session('auth')==false)
                    <div class="alert alert-danger" role="alert">
                        Неправильный логин или пароль!
                    </div>
                @endif
                <form method="POST" action="{{route('loginPost')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputLogin" class="form-label">Ваш логин</label>
                        <input type="text" class="form-control @error('login') is-invalid @enderror" id="inputLogin" name="login" aria-describedby="inputLoginValidation">
                        @error('login')
                        <div id="inputLoginValidation" class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Ваш пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" aria-describedby="inputPasswordValidation">
                        @error('password')
                        <div id="inputPasswordValidation" class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Авторизоваться</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

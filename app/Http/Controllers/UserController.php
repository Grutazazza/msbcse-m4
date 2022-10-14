<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegistrationValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Переход на страницу регистрации
     */
    public function register()
    {
        return view('users.register');
    }

    /**
     * @param RegistrationValidation $request
     * @return \Illuminate\Http\RedirectResponse
     * Функция регистрации(создание нового пользователя)
     */
    public function registerPost(RegistrationValidation $request)
    {
        $requests = $request->validated();
        unset($requests['photo']);
        $photo = $request->file('photo')->store('public');

        $requests['password']=Hash::make($requests['password']);
        $requests['photo']=explode('/',$photo)[1];
        User::create($requests);
        return redirect()->route('login');
    }

    /**
     * Шаблон авторизации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * POST запрос на обработку шаблона login
     * @param LoginValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(LoginValidation $request)
    {
        $valid = $request->validated();
        if(Auth::attempt($valid)){
            $request->session()->regenerate();
            return redirect()->route('main');
        }
        return back()->with(['auth'=>false]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Переход на страницу кабинета
     */
    public function cabinet()
    {
        return view('users.cabinet');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Выход из пользователя
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('main');
    }
}

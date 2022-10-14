<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TelegramCommandController;
use App\Http\Controllers\TelegramSettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('login',[UserController::class,'login'])->name('login');
Route::post('login',[UserController::class,'loginPost'])->name('loginPost');

Route::get('logout',[UserController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function (){
    Route::resource('telegram-setting', TelegramSettingController::class)->parameters(['telegram-setting'=>'telegramSetting']);
    Route::resource('telegram-command', TelegramCommandController::class)->parameters(['telegram-command'=>'telegramCommand']);
});

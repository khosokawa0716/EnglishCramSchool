<?php

use Illuminate\Http\Request;
use App\Http\Controllers\WordQuestionController;

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user', function () { return Auth::user(); })->name('user'); // ログインユーザーの返却

// Route::post('/create-word-question/register', 'WordQuestionController@create')->name('wordQuestion.create'); // 案件登録
Route::post('/create-word-question/register', [WordQuestionController::class, 'create'])->name('wordQuestion.create'); // 案件登録
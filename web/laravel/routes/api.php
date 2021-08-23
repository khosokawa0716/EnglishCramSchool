<?php

use Illuminate\Http\Request;
use App\Http\Controllers\WordQuestionController;

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user', function () { return Auth::user(); })->name('user'); // ログインユーザーの返却

Route::put('/edit-word-question/{id}', [WordQuestionController::class, 'update'])->name('wordQuestion.update'); // 単語問題編集画面の表示
Route::get('/word-question-list', [WordQuestionController::class, 'readall'])->name('wordQuestion.readall'); // 単語問題一覧画面の表示
Route::get('/edit-word-question/{id}', [WordQuestionController::class, 'read'])->name('wordQuestion.read'); // 単語問題編集画面の表示
Route::post('/create-word-question/register', [WordQuestionController::class, 'create'])->name('wordQuestion.create'); // 単語問題登録
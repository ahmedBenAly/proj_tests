<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;


Route::get('/', [PagesController::class,'firtsRoute'])->name('main');

Route::get('/login', [PagesController::class,'toLogIn'])->middleware('guest')->name('login');
Route::post('/login', [PagesController::class,'logIn']);


Route::get('/signup',[PagesController::class,'toSignUp'])->middleware('guest')->name('signup');

Route::post('/signup',[PagesController::class,'signUp']);

Route::get('/home',[PagesController::class,'homeRoute'])->middleware('auth')->name('home');

Route::post('/logOut',[PagesController::class,'logOut']);

Route::post('/addTask',[PagesController::class,'addTask']);

Route::post('/deleteT/{id}',[PagesController::class,'deleteTask']);

Route::get('/updateT/{id}',[PagesController::class,'updateT']);
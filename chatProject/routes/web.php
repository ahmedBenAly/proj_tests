<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

//GET
Route::get('/',[PagesController::class,'initPage'])->name('initPage');
Route::get('/signup',[PagesController::class,'signupScreen'])->middleware('guest')->name('signup');
Route::get('/login',[PagesController::class,'loginScreen'])->middleware('guest')->name('login');
Route::get('/userScreen',[PagesController::class,'userScreen'])->middleware('auth')
->name('userScreen');
Route::get('/chatwith/{id}',[PagesController::class,'chatwith'])->name('chatscreen');
//GET


//POST
Route::post('/login',[PagesController::class,'login']);
Route::post('/newAcc',[PagesController::class,'newAcc']);
Route::post('/logout',[PagesController::class,'logOut']);
Route::post('/send/{id}',[PagesController::class,'sendMessage'])->name('send');
//POST


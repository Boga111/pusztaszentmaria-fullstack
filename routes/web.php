<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MariaController;

#Főoldal
Route::view('/', 'welcome');

#Hírek
Route::get('/hirek', [MariaController::class, 'Hirek']);

#Vendégkönyv
Route::get('/vendegkonyv', [MariaController::class, 'Vendegkonyv']);
Route::get('/torles/{id}', [MariaController::class, 'Moderalas']);
Route::post('/vendegkonyv', [MariaController::class, 'VendegkonyvButton']);

#Regisztráció
Route::get('/reg', [UserController::class, 'Reg']);
Route::post('/reg', [UserController::class, 'RegButton']);

#Belépés
Route::get('/login', [UserController::class, 'Login']);
Route::post('/login', [UserController::class, 'LoginButton']);

#Profiloldal
Route::get('/profil', [UserController::class, 'Profil']);

#Jelszómódosítás
Route::get('/newpass', [UserController::class, 'NewPass']);
Route::post('/newpass', [UserController::class, 'NewPassButton']);

#Kilépés
Route::get('/logout', [UserController::class, 'Logout']);
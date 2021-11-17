<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;


//PUBLIC
Route::get("/", [PublicController::class, 'Home'])->name("home");
Route::get("/araink", [PublicController::class, "Prices"])->name("prices");
Route::get("/csoportok", [PublicController::class, "Classes"])->name("classes");
Route::get("/szolgaltatasok", [PublicController::class, "Services"])->name("service");
Route::get("/kapcsolat", [PublicController::class, "Contact"])->name("contact");
Route::get("/profilom", [PublicController::class, "Profile"])->name("profile");
Route::get("/orarendek", [PublicController::class, "Timetable"])->name("timetable");
Route::get("/bmi-kalkulator", [PublicController::class, "Bmi"])->name("bmi");
Route::get("/galeria", [PublicController::class, "Gallery"])->name("gallery");
Route::get("/blog", [PublicController::class, "Blog"])->name("blog");
Route::get("/profilom", [PublicController::class, "Profile"])->name("profile");
Route::post("/profilom", [PublicController::class, "ProfilUpdate"])->name("profilUpdate");

//LOGIN /  REGISZRÁCIÓ / ELFELEJTETT JELSZÓ
Route::get('/bejelentkezes', [AuthController::class, 'Login'])->name('login');
Route::post('/bejelentkezes', [AuthController::class, 'LoginAttempt'])->name('loginAttempt');

Route::get('/regisztracio', [AuthController::class, 'Regist'])->name('regist');
Route::post('/regisztracio', [AuthController::class, 'SendRegist'])->name('sendregist');
Route::get('/regisztracio/sikeres', [AuthController::class, 'SuccessReg'])->name('successreg');

Route::get('/elfelejtett-jelszo', [AuthController::class, 'LostPassword'])->name('lostPassword');
Route::post('/elfelejtett-jelszo', [AuthController::class, 'SendLostPassword'])->name('sendLostPassword');
Route::get('/elfelejtett-jelszo/{email}/{code}', [AuthController::class, 'ChangeLostPassword'])->name('changeLostPassword');
Route::post('/elfelejtett-jelszo-modositas', [AuthController::class, 'SendChangeLostPassword'])->name('sendChangeLostPassword');

Route::get('/kijelentkezes', [AuthController::class, 'LogOut'])->name('logout');

//ADMIN
Route::get("/admin", [AdminController::class, 'Dashboard'])->name("admin");

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminUserController;

//PUBLIC

    Route::get("/", [PublicController::class, 'Home'])->name("home");
    Route::get("/araink", [PublicController::class, "Prices"])->name("prices");
    Route::get("/csoportok", [PublicController::class, "Classes"])->name("classes");
    Route::get("/szolgaltatasok", [PublicController::class, "Services"])->name("service");
    Route::get("/kapcsolat", [PublicController::class, "Contact"])->name("contact");
    Route::get("/orarendek", [PublicController::class, "Timetable"])->name("timetable");
    Route::get("/bmi-kalkulator", [PublicController::class, "Bmi"])->name("bmi");
    Route::get("/galeria", [PublicController::class, "Gallery"])->name("gallery");
    Route::get("/blog", [PublicController::class, "Blog"])->name("blog");

//PROFIL ÉS MÁS ADATOK

    //Profil :
    Route::get("/profilom/{anchor?}", [ProfilController::class, "Profile"])->name("profile");
    Route::post("/profilom", [ProfilController::class, "ProfileUpdate"])->name("profileUpdate");

    //Jelszó módosítás :
    Route::post("/profilom/jelszo-modositas", [AuthController::class, "ChangePassword"])->name("ChangePassword");

    //Számlázási cím :
    Route::post('/uj-szamlazasi-cim', [ProfilController::class, 'BillingAddressNew'])->name('billingAddressNew');
    Route::post('/szamlazasi-cim-modositas', [ProfilController::class, 'BillingAddressUpdate'])->name('billingAddressUpdate');
    Route::post('/szamlazasi-cim-torlese', [ProfilController::class, 'BillingAddressDelete'])->name('billingAddressDelete');

    //Szállítási cím :
    Route::post('/uj-szallitasi-cim', [ProfilController::class, 'ShippingAddressNew'])->name('shippingAddressNew');
    Route::post('/szallitasi-cim-modositasa', [ProfilController::class, 'ShippingAddressUpdate'])->name('shippingAddressUpdate');
    Route::post('/szallitasi-cim-torlese', [ProfilController::class, 'ShippingAddressDelete'])->name('shippingAddressDelete');

//LOGIN /  REGISZRÁCIÓ / ELFELEJTETT JELSZÓ

    //Bejelentkezés :
    Route::get('/bejelentkezes', [AuthController::class, 'Login'])->name('login');
    Route::post('/bejelentkezes', [AuthController::class, 'LoginAttempt'])->name('loginAttempt');

    //Regisztráció :
    Route::get('/regisztracio', [AuthController::class, 'Regist'])->name('regist');
    Route::post('/regisztracio', [AuthController::class, 'SendRegist'])->name('sendregist');
    Route::get('/regisztracio/sikeres', [AuthController::class, 'SuccessReg'])->name('successreg');

    //Elfelejtett jelszó :
    Route::get('/elfelejtett-jelszo', [AuthController::class, 'LostPassword'])->name('lostPassword');
    Route::post('/elfelejtett-jelszo', [AuthController::class, 'SendLostPassword'])->name('sendLostPassword');
    Route::get('/elfelejtett-jelszo/{email}/{code}', [AuthController::class, 'ChangeLostPassword'])->name('changeLostPassword');
    Route::post('/elfelejtett-jelszo-modositas', [AuthController::class, 'SendChangeLostPassword'])->name('sendChangeLostPassword');

    //Kijelentkezés :
    Route::get('/kijelentkezes', [AuthController::class, 'LogOut'])->name('logout');

//ADMIN
    Route::group(["prefix"=>"admin"], function(){

        Route::get("/", [AdminController::class, 'Dashboard'])->name("admin");
        //FELHASZNÁLÓK
        Route::group(["prefix"=>"users"], function(){

            Route::get('/', [AdminUserController::class, "index"])->name("adminUsers");
            Route::get('/create', [AdminUserController::class, "create"])->name("adminUserCreate");
            Route::post('/store', [AdminUserController::class, "store"])->name("adminUserStore");
            Route::get('/edit/{userid}', [AdminUserController::class, "edit"])->name("adminUserEdit");
            Route::post('/update/{userid}', [AdminUserController::class, "update"])->name("adminUserUpdate");
            Route::get('/destroy/{userid}', [AdminUserController::class, "destroy"])->name("adminUserDestroy");
        });
    });
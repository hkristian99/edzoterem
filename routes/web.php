<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WebshopController;
use App\Http\Controllers\WorkoutController;


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
    
    Route::get("/jelszo-modositas", [AuthController::class, "PasswordStatus"])->name("PasswordStatus");
    Route::post("/jelszo-modositas", [AuthController::class, "SendPasswordStatus"])->name("sendPasswordStatus");

    //Kijelentkezés :
    Route::get('/kijelentkezes', [AuthController::class, 'LogOut'])->name('logout');


//PROFIL ÉS MÁS ADATOK
Route::group(["prefix"=>"profilom", 'middleware' => 'checkLogin'], function(){
    //Profil :
    Route::post("/", [ProfilController::class, "ProfileUpdate"])->name("profileUpdate");
    Route::get("/{anchor?}", [ProfilController::class, "Profile"])->name("profile");

    //Jelszó módosítás :
    Route::post("/jelszo-modositas", [AuthController::class, "ChangePassword"])->name("ChangePassword");

    //Számlázási cím :
    Route::post('/uj-szamlazasi-cim', [ProfilController::class, 'BillingAddressNew'])->name('billingAddressNew');
    Route::post('/szamlazasi-cim-modositas', [ProfilController::class, 'BillingAddressUpdate'])->name('billingAddressUpdate');
    Route::post('/szamlazasi-cim-torlese', [ProfilController::class, 'BillingAddressDelete'])->name('billingAddressDelete');

    //Szállítási cím :
    Route::post('/uj-szallitasi-cim', [ProfilController::class, 'ShippingAddressNew'])->name('shippingAddressNew');
    Route::post('/szallitasi-cim-modositasa', [ProfilController::class, 'ShippingAddressUpdate'])->name('shippingAddressUpdate');
    Route::post('/szallitasi-cim-torlese', [ProfilController::class, 'ShippingAddressDelete'])->name('shippingAddressDelete'); 
});

//ADMIN
    Route::group(["prefix"=>"admin", 'middleware' => 'isNotVisitor'], function(){

        Route::get("/", [AdminController::class, 'Dashboard'])->name("admin");
        Route::get("/naptar", [AdminController::class, 'Calendar'])->name("calendar");
        Route::get("/napi-teendo", [AdminController::class, 'Daily'])->name("daily");
        Route::post("/napi-teendo/hozzaadas", [AdminController::class, 'AddDailyTask'])->name("addDailyTask");
        Route::get("/napi-teendo/lista-torlese", [AdminController::class, 'DeleteTasks'])->name("deleteTasks");

        //FELHASZNÁLÓK
        Route::group(["prefix"=>"users"], function(){

            Route::get('/', [AdminUserController::class, "index"])->name("adminUsers");
            Route::get('/create', [AdminUserController::class, "create"])->name("adminUserCreate");
            Route::post('/store', [AdminUserController::class, "store"])->name("adminUserStore");
            Route::get('/edit/{userid}', [AdminUserController::class, "edit"])->name("adminUserEdit");
            Route::post('/update/{userid}', [AdminUserController::class, "update"])->name("adminUserUpdate");
        });

        //BLOGOK
        Route::group(["prefix"=>"blogs"], function(){
            Route::get('/osszes', [BlogController::class, "index"])->name('blogAll');
            Route::get('/sajat', [BlogController::class, "indexByUser"])->name('blogByUser');
            Route::get('/uj', [BlogController::class, "create"])->name('blogCreate');
            Route::post('/store', [BlogController::class, "store"])->name('blogStore');
            Route::get('/szerkesztes/{postid}', [BlogController::class, "edit"])->name('blogEdit');
            Route::post('/update/{postid}', [BlogController::class, "update"])->name('blogUpdate');
            Route::get('/torles/{postid}', [BlogController::class, "destroy"])->name('blogDestroy');
            Route::get('/bejegyzesstatusza', [BlogController::class, "PostStatus"])->name('postStatus');
            Route::get('/{postid}/approval', [BlogController::class, "PostApproval"])->name('postApproval');
        });

        //EDZÉS
        Route::group(["prefix"=>"workout"], function(){
            Route::get('/edzestervek', [WorkoutController::class, "index"])->name('workoutPlans');
            Route::get('/etrendek', [WorkoutController::class, "Diet"])->name('workoutDiet');
            Route::get('/jegyzetfuzet', [WorkoutController::class, "Notes"])->name('workoutNotes');
        });

        //WEBSHOP
        Route::group(["prefix"=>"webshop"], function(){
            Route::get('/termekek', [WebshopController::class, "index"])->name('products');
            Route::get('/uj', [WebshopController::class, "create"])->name('productCreate');
            Route::get('/kedvezmenyes-termekek', [WebshopController::class, "discont"])->name('productDiscont');
            Route::get('/termekotletek', [WebshopController::class, "productIdeas"])->name('productIdeas');
            Route::post('/store', [WebshopController::class, "store"])->name('productStore');
            Route::get('/szerkesztes/{productid}', [WebshopController::class, "edit"])->name('productEdit');
            Route::post('/update/{productid}', [WebshopController::class, "update"])->name('productUpdate');
            Route::get('/torles/{productid}', [WebshopController::class, "destroy"])->name('productDestroy');
            Route::get('/termekstatusza', [WebshopController::class, "PostStatus"])->name('productStatus');
            Route::get('/{productid}/approval', [WebshopController::class, "PostApproval"])->name('productApproval');
        });
    });
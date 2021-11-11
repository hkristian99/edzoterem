<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;


//PUBLIC
Route::get("/", [PublicController::class, 'Home'])->name("home");
Route::get("/rolunk", [PublicController::class, "About"])->name("about");
Route::get("/csoportok", [PublicController::class, "Classes"])->name("classes");
Route::get("/szolgaltatasok", [PublicController::class, "Services"])->name("service");
Route::get("/csapatunk", [PublicController::class, "Team"])->name("team");
Route::get("/kapcsolat", [PublicController::class, "Contact"])->name("contact");
Route::get("/profilom", [PublicController::class, "Profile"])->name("profile");
Route::get("/orarendek", [PublicController::class, "Timetable"])->name("timetable");
Route::get("/bmi-kalkulator", [PublicController::class, "Bmi"])->name("bmi");
Route::get("/galeria", [PublicController::class, "Gallery"])->name("gallery");
Route::get("/blog", [PublicController::class, "Blog"])->name("blog");

//ADMIN
Route::get("/admin", [AdminController::class, 'Dashboard'])->name("admin");

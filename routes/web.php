<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;


//PUBLIC
Route::get("/", [PublicController::class, 'Home'])->name("kezdolap");

//ADMIN
Route::get("/admin", [AdminController::class, 'Dashboard'])->name("dashboard");

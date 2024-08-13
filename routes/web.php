<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MessageUrlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "22";
});

Route::get("/device", [DeviceController::class, "index"])->name("device")->middleware("auth");
Route::get("/login", [AuthController::class, "showLoginForm"])->name("login")->middleware("guest");
Route::post("/login", [AuthController::class, "login"])->name("login")->middleware("guest");
Route::get("/signup", [UserController::class, "create"])->name("signup")->middleware("guest");
Route::post("users/store",  [UserController::class, "store"])->name("users.store")->middleware("guest");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::get("/device/{id}/edit", [DeviceController::class, "edit"])->name("device.edit");
Route::post("/device/update/{id}", [DeviceController::class, "update"])->name("device.update");
Route::post("/devices{id}", [DeviceController::class, "destroy"])->name("device.destroy");
Route::post("/devices/create", [DeviceController::class, "store"])->name("device.store");


Route::get("/device/show/{id}", [DeviceController::class, "show"])->name("device.show");

Route::post("/url/update/{id}", [MessageUrlController::class, "update"])->name("url.update");
Route::get("/url/edit/{id}", [MessageUrlController::class, "edit"])->name("url.edit");
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\MessageUrlController;
use App\Http\Controllers\RegistrationMessageController;
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

Route::get("/device/{id}/edit", [DeviceController::class, "edit"])->name("device.edit")->middleware("auth");
Route::post("/device/update/{id}", [DeviceController::class, "update"])->name("device.update")->middleware("auth");
Route::post("/devices{id}", [DeviceController::class, "destroy"])->name("device.destroy")->middleware("auth");
Route::post("/devices/create", [DeviceController::class, "store"])->name("device.store")->middleware("auth");

Route::get("/device/show/{id}", [DeviceController::class, "show"])->name("device.show")->middleware("auth");
Route::post("/url/update/{id}", [MessageUrlController::class, "update"])->name("url.update")->middleware("auth");
Route::get("/url/edit/{id}", [MessageUrlController::class, "edit"])->name("url.edit")->middleware("auth");
Route::get("/message/edit/{id}", [RegistrationMessageController::class, "edit"])->name("message.edit")->middleware("auth");
Route::post("/message/update/{id}", [RegistrationMessageController::class, "update"])->name("message.update")->middleware("auth");


Route::get("/group_message/edit/{id}", [GroupMessageController::class, "edit"])->name("group_message.edit")->middleware("auth");
Route::post("/group_message/update/{id}", [GroupMessageController::class, "update"])->name("group_message.update")->middleware("auth");
Route::delete("/group_message/delete/{id}", [GroupMessageController::class, "destroy"])->name("group_message.destroy");
Route::post("/group_message/create", [GroupMessageController::class, "store"])->name("group_message.store")->middleware("auth");
Route::post("/group_message/is_sent/update/{id}", [GroupMessageController::class, "updateIsSent"])->name("groupMsg.update");
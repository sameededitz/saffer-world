<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\ServerController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerifyController;
use App\Http\Controllers\OptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::post('/signup', [AuthController::class, 'signup'])->name('api.login');

    Route::post('/reset-password', [VerifyController::class, 'sendResetLink'])->name('api.reset.password');

    Route::post('/password/reset', [VerifyController::class, 'resetPassword'])->name('api.new.password');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::post('/purchase', [PurchaseController::class, 'addPurchase'])->name('api.add.purchase');

    Route::post('/purchase/status', [PurchaseController::class, 'Status'])->name('api.purchase');

    Route::post('/user/register-device', [UserController::class, 'registerDevice'])->name('api.register.device');

    Route::post('/user/devices', [UserController::class, 'AllDevices'])->name('api.get.devices');

    Route::post('/user/check-device', [UserController::class, 'checkDevice'])->name('api.check.device');

    Route::delete('/user/device/delete', [UserController::class, 'deleteDevice'])->name('api.delete.device');

    Route::get('/servers', [ServerController::class, 'index'])->name('api.all.servers');
});

Route::post('/email/resend-verification', [VerifyController::class, 'resendVerify'])->name('api.verify.resend');


Route::get('/streams', [ServerController::class, 'streams'])->name('api.all.streams');

Route::get('/plans', [ServerController::class, 'plans'])->name('api.all.plans');

Route::get('/options', [OptionController::class, 'getOptions'])->name('api.options');

Route::post('/login/google', [SocialController::class, 'LoginGoogle'])->name('api.login.google');

Route::post('/login/apple', [SocialController::class, 'loginApple'])->name('api.login.apple');

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SubServerController;
use App\Http\Controllers\UserDeviceController;
use App\Livewire\NotificationAdd;
use App\Livewire\SubServerAdd;
use App\Livewire\SubServerEdit;
use App\Livewire\UserEdit;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'verifyRole:admin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin-home');

    Route::get('/servers', [ServerController::class, 'Index'])->name('all-servers');

    Route::get('/add-server', [ServerController::class, 'AddServer'])->name('add-server');

    Route::get('/server/{server}/edit', [ServerController::class, 'EditServer'])->name('edit-server');

    Route::post('/server/{server}/status', [ServerController::class, 'Status'])->name('server-status');

    Route::delete('/delete-server/{server}', [ServerController::class, 'DeleteServer'])->name('delete-server');

    Route::get('/{server}/sub-servers', [SubServerController::class, 'Index'])->name('all-sub-servers');

    Route::get('/{server}/sub-server/add', SubServerAdd::class)->name('add-sub-server');

    Route::get('/{server}/sub-servers/{subServer}/edit', SubServerEdit::class)->name('edit-sub-server');

    Route::delete('/{server}/sub-servers/{subServer}', [SubServerController::class, 'Delete'])->name('delete-sub-server');

    Route::get('/plans', [PlanController::class, 'Plans'])->name('all-plans');
    Route::get('/add-plan', [PlanController::class, 'AddPlan'])->name('add-plan');
    Route::get('/plans/{plan:slug}', [PlanController::class, 'EditPlan'])->name('edit-plan');
    Route::delete('/plans/{plan:slug}', [PlanController::class, 'deletePlan'])->name('delete-plan');

    Route::get('/users', [AdminController::class, 'AllUsers'])->name('all-users');
    Route::get('/add/user', [AdminController::class, 'addUser'])->name('add-user');
    Route::get('/user/{user}/edit', UserEdit::class)->name('edit-user');
    Route::delete('/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('delete-user');

    Route::get('/user/{user}/devices', [UserDeviceController::class, 'index'])->name('user-devices');
    Route::delete('/devices/{device}/delete', [UserDeviceController::class, 'delete'])->name('delete-device');

    Route::get('/options', [OptionController::class, 'Options'])->name('all-options');
    Route::post('/options/save', [OptionController::class, 'saveOptions'])->name('save-options');

    Route::get('/admins-users', [AdminController::class, 'allAdmins'])->name('all-admins');

    Route::get('/admins/add', [AdminController::class, 'addAdmin'])->name('add-admin');

    Route::get('/edit-admin/{user}', [AdminController::class, 'editAdmin'])->name('edit-admin');

    Route::delete('/delete-admin/{user}', [AdminController::class, 'deleteAdmin'])->name('delete-admin');
});

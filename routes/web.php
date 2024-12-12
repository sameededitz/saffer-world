<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin-home');
    }
    return redirect()->route('login');
})->name('home');

Route::get('/optimize', function (Request $request) {
    Artisan::call('optimize:clear');
    return 'Optimized';
});

Route::get('/storage-link', function (Request $request) {
    Artisan::call('storage:link');
    return 'Linked';
});

Route::get('email/verify/view/{id}/{hash}', [VerifyController::class, 'viewEmail'])->name('email.verification.view');
Route::get('password/reset/view/{email}/{token}', [VerifyController::class, 'viewInBrowser'])->name('password.reset.view');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');

    Route::post('/login-user', [AuthController::class, 'login'])->name('login-user')->middleware('throttle:login-user');

    Route::get('/signup', [AuthController::class, 'signupForm'])->name('signup');

    Route::post('/register-user', [AuthController::class, 'register'])->name('register-user');

    Route::get('/forgot-password', [VerifyController::class, 'forgotPass'])->name('password.request');

    Route::post('/forgot-password/email', [VerifyController::class, 'resetPassLink'])->name('password.email');

    Route::get('/reset-password/{token}', [VerifyController::class, 'resetPassForm'])->name('password.reset');

    Route::post('/reset-password/new', [VerifyController::class, 'NewPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerifyController::class, 'showNotice'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->withoutMiddleware(['auth'])->name('verification.verify');

    Route::post('/email/verification-notification', [VerifyController::class, 'ResentEmail'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

require __DIR__ . '/admin.php';


Route::get('/api-docs', function () {
    return view('docs.api-docs');
})->name('api-docs');

Route::get('/send-test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('This is a test email', function ($message) {
        $message->to('sameedhassan22@gmail.com')
            ->subject('Test Email');
    });

    return 'Test email sent';
});

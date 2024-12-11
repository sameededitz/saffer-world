<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class VerifyController extends Controller
{
    public function EmailPrompt(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->route('login')
            : view('auth.login');
    }

    public function showNotice()
    {
        return view('auth.verify-email');
    }

    public function ResentEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login');
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'A new verification link has been sent to the email address you provided during registration.');
    }

    public function verify(Request $request)
    {
        $user = Auth::user() ? Auth::user() : User::findOrFail($request->route('id'));
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? response()->json([
                    'status' => true,
                    'message' => 'Email already Verified'
                ], 200)
                : redirect()->route('home')->with('verified', true);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $request->wantsJson()
            ? response()->json([
                'status' => true,
                'message' => 'Email verified successfully!'
            ], 200)
            : view('auth.verified-email');
    }

    public function forgotPass()
    {
        return view('auth.forgot-password');
    }

    public function resetPassLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function NewPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }


    public function viewEmail($id, $hash)
    {
        $user = User::findOrFail($id);

        if (hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return view('email.custom-email-verfication', [
                'user' => $user,
                'verificationUrl' => URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                    [
                        'id' => $user->getKey(),
                        'hash' => sha1($user->getEmailForVerification()),
                    ]
                ),
                'viewInBrowserUrl' => null,
            ]);
        }
        abort(403);
    }

    public function viewInBrowser($email, $token)
    {
        $user = User::where('email', $email)->first();

        return view('email.custom-password-reset', [
            'user' => $user,
            'resetUrl' => route('password.reset', ['token' => $token, 'email' => $email]),
            'viewInBrowserUrl' => null,
        ]);
    }
}

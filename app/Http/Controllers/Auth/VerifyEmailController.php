<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) { 
            event(new Verified($request->user()));

            try {
                Mail::to($request->user()->email)->send(new WelcomeMail($request->user()));
            } catch (\Throwable $e) {
                Log::warning('Welcome email could not be sent: ' . $e->getMessage());
            }
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
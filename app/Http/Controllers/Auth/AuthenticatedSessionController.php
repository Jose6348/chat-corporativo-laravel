<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Mail\TwoFactorCodeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (! Auth::validate($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => __('auth.failed'),
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $user->generateTwoFactorCode();

        $request->session()->put('user_id_for_2fa', $user->id);

        Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));

        return redirect()->route('2fa.challenge')
            ->with('status', 'Enviamos um código para o seu e-mail.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

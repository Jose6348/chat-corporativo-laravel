<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    /**
     * Mostra a view do desafio 2FA.
     * (Este é o método que estava faltando e causando o erro)
     */
    public function create(): View
    {
        return view('auth.two-factor-challenge');
    }

    /**
     * Verifica o código 2FA enviado.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $userId = $request->session()->get('user_id_for_2fa');

        if (!$userId) {
            return back()->withErrors(['code' => 'Sua sessão expirou. Por favor, tente fazer login novamente.']);
        }

        $user = User::findOrFail($userId);

        if ($request->code !== $user->two_factor_code) {
            return back()->withErrors(['code' => 'O código de verificação está incorreto.']);
        }

        if (now()->gt($user->two_factor_expires_at)) {
            return back()->withErrors(['code' => 'O código de verificação expirou. Por favor, tente fazer login novamente.']);
        }

        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        $request->session()->forget('user_id_for_2fa');

        Auth::login($user, true); 

        return redirect()->intended(route('dashboard'));
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $code = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $code,
                'created_at' => Carbon::now()
            ]
        );

        Mail::raw("Tu código de recuperación es: $code", function ($msg) use ($request) {
            $msg->to($request->email)
                ->subject('Código de recuperación de contraseña');
        });

        return redirect()->route('password.verify')
            ->with('email', $request->email)
            ->with('success', 'Código enviado a tu correo.');
    }
    public function resendCode($email)
    {
        $userExists = DB::table('users')->where('email', $email)->exists();

        if (!$userExists) {
            return redirect()->back()->with('error', 'El correo no existe.');
        }

        $code = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $code,
                'created_at' => Carbon::now()
            ]
        );

        Mail::raw("Tu nuevo código de recuperación es: $code", function ($msg) use ($email) {
            $msg->to($email)->subject('Nuevo código de recuperación');
        });

        return redirect()->route('password.verify')
            ->with('email', $email)
            ->with('success', 'Nuevo código enviado a tu correo.');
    }
}

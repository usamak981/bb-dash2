<?php


namespace App\Http\Controllers;


use App\Models\UserCode;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class TwoFactorAuthController extends Controller
{
    /**
     * index method for 2fa
     *
     * @return View
     */

    public function index()
    {
        return view('content/auth/2fa');
    }

    /**
     * validate sms
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
        ]);

        UserCode::where('user_id', auth()->user()->id)
            ->where('updated_at', '<', now()->subMinutes(60))
            ->delete();

        $exists = UserCode::where('user_id', auth()->user()->id)
            ->where('code', $validated['code'])
            ->where('updated_at', '>=', now()->subMinutes(10))
            ->exists();


        if ($exists) {
            Session::put('user_2fa', auth()->user()->id);
            Session::put('locale',auth()->user()->lang);
            return redirect(RouteServiceProvider::DASHBOARD);
        }

        return redirect()
            ->back()
            ->with('error', 'You entered wrong OTP code.');
    }

    /**
     * resend otp code
     *
     * @return RedirectResponse
     */
    public function resend()
    {
        auth()->user()->generateCode();

        return back()
            ->with('success', 'We have resent OTP on your mobile number.');
    }
}

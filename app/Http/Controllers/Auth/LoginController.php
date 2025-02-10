<?php

namespace App\Http\Controllers\Auth;

use App\Models\Option;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // Ambil data JSON dari database
        $toolsSettings = Option::where('option_name', 'setting_captcha')->first();
        // Decode JSON menjadi array atau objek
        $opt_api = json_decode($toolsSettings->option_value, true);

        return view('auth.login', [
            'opt_api' => $opt_api['recaptcha_keys']
        ]);
    }


    protected function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Ambil pengaturan reCAPTCHA dari database
        $toolsSettings = Option::where('option_name', 'setting_captcha')->first();
        $opt_api = json_decode($toolsSettings->option_value, true);

        // Periksa status reCAPTCHA
        if ($opt_api['recaptcha_keys']['status'] == 'enable') {
            // Validasi reCAPTCHA jika diaktifkan
            $validator->sometimes('g-recaptcha-response', 'required', function ($input) use ($request) {
                return true;
            });

            // Validate the reCAPTCHA response
            if ($request->has('g-recaptcha-response')) {
                $secretKey = $opt_api['recaptcha_keys']['secret_key'];
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secretKey,
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]);

                $result = json_decode($response->body());

                if (!$result->success) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('g-recaptcha-response', 'reCAPTCHA verification failed.');
                    });
                }
            }
        }

        $validator->validate();
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Traits\RespondsWithFlash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use RespondsWithFlash;
    public function __construct(public AuthService $service) {}
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $registered = $this->service->Register($request->validated());
        return $this->respond(
            $registered,
            'User Registered Successfully, Please Login',
            'User Registration Failed',
            redirect()->route('login')
        );
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $logged_in = $this->service->login($request->validated());
        return $this->respond(
            $logged_in,
            'User Logged In Successfully',
            'Wrong Credentials',
            redirect()->route('home')
        );
    }
    public function logout(Request $request)
    {
        $logged_out = $this->service->logout($request);

        return $this->respond(
            $logged_out,
            'User Logged Out Successfully',
            'User Logout Failed',
            redirect()->route('login')
        );
    }
}

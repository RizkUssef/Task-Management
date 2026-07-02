<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Traits\RespondsWithFlash;

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
}

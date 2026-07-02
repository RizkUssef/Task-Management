<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthService
{
    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
        $tenant_id = app('currentTenant')->id;
        $data['tenant_id'] = $tenant_id;
        return User::create($data);
    }
    public function login($data)
    {
        $tenant_id = app('currentTenant')->id;

        $credentials = [
            'email'     => $data['email'],
            'password'  => $data['password'],
            'tenant_id' => $tenant_id,
        ];
        return Auth::attempt($credentials);
    }
    public function logout(Request$request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return true;
        }
        return false;
    }
}

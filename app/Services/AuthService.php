<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
        $tenant_id = app('currentTenant')->id;
        $data['tenant_id'] = $tenant_id;
        return User::create($data);
    }
}

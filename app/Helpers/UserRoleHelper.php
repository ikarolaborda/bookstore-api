<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class UserRoleHelper
{
    public static function canCreateAdmin(Request $request): bool
    {
        $user = $request->user();
        return $user && $user->role === 'admin';
    }
}

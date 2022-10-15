<?php

namespace Crm\User\Services;

use Crm\User\Models\User;
use Crm\User\Requests\UserCreation;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(UserCreation $request): ?User
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();

        event(new \Crm\User\Events\UserCreation($user));
        return $user;
    }
}

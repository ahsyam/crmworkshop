<?php

namespace App\Http\Controllers;

use Crm\User\Requests\UserCreation;
use Crm\User\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;
    const TOKEN_NAME = 'personal';

    public function __construct( UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserCreation $request)
    {
        $user = $this->userService->create($request);
        return response()->json(
            [
                'user' => $user,
                'token' => $user->createToken(self::TOKEN_NAME)->plainTextToken
            ]

        );
    }
}

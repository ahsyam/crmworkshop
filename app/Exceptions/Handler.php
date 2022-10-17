<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthorizationException $e) {
                return response()->json([
                    "status" => "error",
                    'errors' => [
                        'generic' =>'Not authenticated'
                        ]
                ], JsonResponse::HTTP_UNAUTHORIZED);
        });
        $this->renderable(function (Throwable $e) {
                return response()->json([
                    "status" => "error",
                    'errors' => ['generic' =>'Unknown error']
                ], JsonResponse::HTTP_BAD_REQUEST);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

<?php

namespace App\Exceptions;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        $this->renderable(function (Exception $e, $request) {
            try {
                //Access token from the request
                $token = JWTAuth::parseToken();
                //Try authenticating user
                $user = $token->authenticate();
            } catch (TokenExpiredException $e) {
                //Thrown if token has expired
                return $this->unauthorized('Your token has expired. Please, login again.');
            } catch (TokenInvalidException $e) {
                //Thrown if token invalid
                return $this->unauthorized('Your token is invalid. Please, login again.');
            } catch (JWTException $e) {
                //Thrown if token was not found in the request.
                return $this->unauthorized('Please, attach a Bearer Token to your request');
            }
        });

        return response()->json(['error' => 'Not Found!'], 404);

        $this->reportable(function (Throwable $e) {
        });
    }

    private function unauthorized($message = null)
    {
        return response()->json([
            'message' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false
        ], 401);
    }
}

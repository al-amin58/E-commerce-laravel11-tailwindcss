<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    // Define the list of exception types that should not be reported
    protected $dontReport = [
        // Add any exceptions that you don't want to report
    ];

    // A list of the input that should never be flashed to the session on validation exceptions.
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    // Render an exception into an HTTP response.
    public function render($request, Throwable $exception)
    {
        // If the exception is a 404, return the custom 404 view
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Check for 500 Internal Server Error
        if ($exception instanceof \ErrorException) {
            return response()->view('errors.500', [], 500);
        }

        // Fallback to the default exception handler
        return parent::render($request, $exception);
    }
}

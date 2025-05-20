<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Custom render method to handle authorization exceptions.
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            view()->replaceNamespace('errors', $this->getErrorViewPath());
            return response()->view('errors::403', [], 403);
        }

        \Log::info('Redirigiendo a login', [
            'exception' => get_class($exception),
            'message' => $exception->getMessage(),
            'url' => $request->fullUrl(),
            'user' => auth()->check() ? auth()->user()->email : 'no autenticado',
        ]);

        return parent::render($request, $exception);
    }

    protected function getErrorViewPath()
    {
        if (tenancy()->initialized) {
            return resource_path('views/tenants/default/errors');
        }

        return resource_path('views/errors');
    }
}

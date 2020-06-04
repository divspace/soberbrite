<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $throwable): void
    {
        parent::report($throwable);
    }

    public function render($request, Throwable $throwable): Response
    {
        return parent::render($request, $throwable);
    }
}

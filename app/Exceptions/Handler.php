<?php

namespace App\Exceptions;

use App\Http\Controllers\Traits\ApiResponse;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    use ApiResponse;
    /**
     * 不会被记录的异常类型数组
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        LoginException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if (!env('APP_DEBUG', false)) {
            switch (get_class($exception)) {
                case LoginException::class:
                    return $this->failed($exception->getMessage(), $exception->data());
            }
        }
        return parent::render($request, $exception);
    }
}

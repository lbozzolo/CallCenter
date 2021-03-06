<?php

namespace SmartLine\Exceptions;

use Bican\Roles\Exceptions\PermissionDeniedException;
use Bican\Roles\Exceptions\RoleDeniedException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof TokenMismatchException)
            return redirect($request->fullUrl())->with('csrf_error',"Se excedió el tiempo de espera para enviar el formulario. Vuelva a intentar.");

        if ($e instanceof ModelNotFoundException)
            $e = new NotFoundHttpException($e->getMessage(), $e);

        if ($e instanceof RoleDeniedException)
            return redirect()->back()->withErrors('Lo sentimos. Usted no tiene el rol requerido.');

        if ($e instanceof PermissionDeniedException)
            return redirect()->route('/')->withErrors('Lo sentimos. Usted no tiene los permisos requeridos.');


        return parent::render($request, $e);
    }
}

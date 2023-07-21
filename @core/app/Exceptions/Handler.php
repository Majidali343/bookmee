<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                if ($request->is('api/v1/*')){
                    return response()->error(['message' => __('nothing found')]);
                }
                return response()->view('frontend.pages.404');
            }
            if ($exception->getStatusCode() == 500 ) {
                if ($request->is('api/v1/*')){
                    return response()->error(['message' => __('server error')]);
                }
                return response()->view('frontend.pages.500');
            }
        }

        if(str_contains($exception->getMessage() , 'Route [login]' )){
            return redirect()->to(route('user.login'))->with(['msg' => __('Cookie expired, Please login'),'type' => 'danger']);
        }

        return parent::render($request, $exception);
    }

}

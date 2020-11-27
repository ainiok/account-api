<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/11/25 15:51
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * 管理员登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * @OA\Post(
     *     path="/admin/login",
     *     tags={"管理员"},
     *     summary="管理员登录",
     *     @OA\Parameter(
     *         name="username",
     *         in="path",
     *         description="账号",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="path",
     *         description="密码",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="captcha",
     *         in="path",
     *         description="验证码",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",description="ok"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
        dd("1111");
    }

    protected function validateLogin(Request $request)
    {
        $this->clearLoginAttempts($request);
        $attempts = $this->getLoginAttempts($request);
        if($this->hasTooManyLoginAttempts($request)){
            $this->sendLockoutResponse($request);
        }
    }

    /**
     * @OA\Get(
     *     path="/admin/index",
     *     tags={"管理员"},
     *     summary="管理员控制台",
     *     @OA\Response(response="200", description="home index")
     * )
     */
    public function index()
    {
        $user = Auth::guard()->user();
    }

    /**
     * 获取登录错误次数
     *
     * @param Request $request
     * @return mixed
     */
    protected function getLoginAttempts(Request $request)
    {
        return $this->limiter()->attempts($this->throttleKey($request));
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $data = [
            'lockFlag' => 1,
            'seconds' => $seconds
        ];
        return '';
    }
}

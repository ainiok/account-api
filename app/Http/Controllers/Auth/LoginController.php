<?php

namespace App\Http\Controllers\Auth;

use App\Events\LockoutEvent;
use App\Exceptions\LoginException;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $attempts = $this->getLoginAttempts($request);
        $v        = Validator::make($request->all(), [
            'email'    => 'required|email|between:5,64',
            'password' => 'required|between:8,64'
        ]);
        $v->sometimes('captcha', 'required', function () use ($attempts) {
            return $attempts >= config('login.captcha_count');
        });
        if ($v->fails()) {
            if(!$v->errors()->has('captcha')){
                $this->sendFailedLoginResponse($request);
            } else {
                $data = ['lock_flag' => 0, 'captcha_flag' => 1];
                throw new LoginException();
            }
        }
    }

    public function login(Request $request)
    {
        // 校验登录信息
        $this->validateLogin($request);
        // 获取登录凭证
        $credentials = $this->credentials($request);
        // 处理用户登录(比较数据库中的账号密码，是否禁用)
        if ($this->guard()->attempt($credentials)) {
            if (Auth::check()) {
                return $this->handleUserAuthenticated($request);
            } else {
                // 二次认证
            }
        }
        // 登录失败
        $this->handleUserAuthenticateFailed($request);
    }

    /**
     * 处理用户认证失败
     *
     * @param $request
     * @throws LoginException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handleUserAuthenticateFailed($request)
    {
        if ($user = Auth::guard()->lastAttempted) {
            if ($user->forbidden) {
                throw new LoginException([]);
            }
        }
        $this->sendFailedLoginResponse($request);
    }

    /**
     * 登录失败响应
     *
     * @param Request $request
     * @throws LoginException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendFailedLoginResponse(Request $request)
    {
        $this->incrementLoginAttempts($request);
        $attempts = $this->getLoginAttempts($request);
        // 判断登录错误次数是否达到阀值
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request, 'user', $attempts);
            return $this->sendLockoutResponse($request);
        }
        $data = ['count' => $attempts, 'captcha_flag' => 0, 'lock_flag' => 0];
        // 达到验证码的阀值则下次登录需要输入验证码
        if ($attempts >= config('login.captcha_count')) {
            $data['captcha_flag'] = 1;
        }
        throw new LoginException(trans('auth.failed'), compact('data'));
    }

    /**
     * Fire an event when a lockout occurs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $userType
     * @param int $attempts
     * @return void
     */
    protected function fireLockoutEvent(Request $request, $userType, $attempts)
    {
        event(new LockoutEvent($request, $userType, $attempts));
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param \Illuminate\Http\Request $request
     * @throws LoginException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $data = ['lock_flag' => 1, 'seconds' => $seconds];
        throw new LoginException('', compact('data'));
    }

    /*
     * 获取登录错误次数
     */
    public function getLoginAttempts(Request $request)
    {
        return $this->limiter()->attempts($this->throttleKey($request));
    }
}

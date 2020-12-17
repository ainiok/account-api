<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/17 17:51
 */
namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CaptchaNotify;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('email', '763303918@qq.com')->first();
        $user->notify(new CaptchaNotify('mail'));
    }
}

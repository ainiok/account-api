<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MailCaptcha extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'times',
        'email',
        'expire_at'
    ];

    /**
     * 返回值中隐藏字段
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    /**
     * 生成邮箱验证码
     *
     * @param string $email
     * @return string
     */
    static function genCodeAndStore($email)
    {
        $code      = self::generate();
        $times     = 0;
        $expire_at = Carbon::now()->addMinutes(config('app.captcha.mail.expired'));
        self::updateOrCreate(compact('email'), compact('code', 'times', 'expire_at'));
        return $code;
    }

    /**
     * 生成验证码
     * @return string
     */
    static function generate()
    {
        $length = config('app.captcha.mail.length');
        $code   = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= mt_rand(0, 9);
        }
        return $code;
    }

    /**
     * 验证邮件验证码
     *
     * @param string $email
     * @param string $code
     * @return bool
     */
    static function check($email, $code)
    {
        $result = self::whereRaw('email = ? and expire_at >= ? and times <' . config('app.captcha.mail.try_times'),
            [$email, Carbon::now()])->first();
        if (!$result) {
            return false;
        } else {
            if ($result->code != $code) {
                //验证码错误，使用次数+1
                $result->increment('times');
                return false;
            } else {
                $result->delete();
                return true;
            }
        }
    }
}

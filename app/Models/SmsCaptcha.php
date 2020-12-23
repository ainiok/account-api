<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SmsCaptcha extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['phone','code','expire_at'];


    /**
     * 生成手机验证码
     *
     * @param $mobile
     * @return string
     */
    static function genCodeAndStore($mobile)
    {
        $code    = self::generate();
        $expTime = Carbon::now()->addSecond(config('app.captcha.sms.expired'));
        self::updateOrCreate([
            ['phone' => $mobile],
            [
                'code'      => $code,
                'expire_at' => $expTime,
                'ip'        => \Request::ip()
            ]
        ]);
        return $code;
    }
}

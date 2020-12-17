<?php
/**
 * Author:ainiok
 * Email: job@ainiok.com
 * DateTime: 2020/11/29 22:04
 */

return [
    'captcha_count'   => env('LOGIN_CAPTCHA_COUNT', 3),     // 弹出验证码密码错误次数
    'lock_count'      => env('LOGIN_LOCK_COUNT', 5),        // 密码错误的最大次数
    'lock_time'       => env('LOGIN_LOCK_TIME', 15),        // 密码错误次数超过阈值锁定时间/分
    'admin_lock_time' => env('ADMIN_LOGIN_LOCK_TIME', 15),  // 管理员登录密码错误次数超过阈值锁定时间/分
];

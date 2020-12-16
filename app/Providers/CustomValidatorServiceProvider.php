<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidatorServiceProvider extends ServiceProvider
{
    const SAFE_CHARTERS_REG = '/[\\\">()=?#|\'&;%<\/!\+`\$\*]/';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 邮箱安全验证
        Validator::extend('safe_input', function ($attribute, $value, $parameters, $validator) {
            return !preg_match(self::SAFE_CHARTERS_REG, $value);
        });
        Validator::replacer('safe_input', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':attribute'], $attribute, $message);
        });
    }
}

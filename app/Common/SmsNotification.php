<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/23 19:46
 */

namespace App\Common;

use Illuminate\Support\Facades\App;

class SmsNotification
{
    protected $message;

    protected $phone;

    public function __construct($message, $phone)
    {
        $this->message = $message;
        $this->phone   = $phone;
    }

    public function send()
    {
        if (App::environment() != 'production') {
            return true;
        }
    }
}

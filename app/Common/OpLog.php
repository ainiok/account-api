<?php

/**
 * Author: xiaojin
 * Date: 2021/5/18
 * Time: 18:35
 */

namespace App\Common;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class OpLog
{

    protected static $actionMap = [
        "GET"    => "查看",
        "POST"   => "添加",
        "PUT"    => "更新",
        "DELETE" => "删除",
    ];

    public function info($msg, $opMethod = null, $opUser = null, $opUid = null)
    {
        $opIp = Request::ip();
        if (!$opMethod) {
            $opMethod = Arr::get(self::$actionMap, strtoupper(Request::method()), '未知');
        }

        if (Auth::check()) {
            $opUser = Auth::user()->email;
            $opUid  = Auth::user()->uid;
        }
        Log::info("[IP：$opIp][用户：$opUser][UID：$opUid][操作：$opMethod]$msg");
    }
}

<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/11/25 15:16
 */

if (!function_exists('uuid_gen')) {
    /**
     * 生成32位的uuid
     */
    function uuid_gen()
    {
        return str_replace('-', '', \Ramsey\Uuid\Uuid::uuid4());
    }
}

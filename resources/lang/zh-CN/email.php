<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/17 19:58
 */
return [
    'captcha' => [
        'subject' => '【ainiok】账户信息修改邮件',
        'title'   => '您正在进行账户信息修改操作,本次的验证码为: <span style="font-size: 200%; color: red;"> :code </span> (该验证码仅在24小时内使用有效，24小时后请重新进行该账户信息修改操作流程。)',
        'footer'  => '如果当前操作非您本人，请立即修改账户密码',
        'tip'     => '小提示：绑定邮箱后，您可以更加方便、安全的修改个人资料、找回密码等操作。此为系统自动发送，请勿回复。工作人员不会向你索取此验证码，请勿泄漏。'
    ],
    'password' => [
        'subject' => '',
    ]
];

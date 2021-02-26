<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/17 19:58
 */
return [
    'captcha'                     => [
        'subject' => '【:app_name】账户信息修改邮件',
        'title'   => '您正在进行账户信息修改操作,本次的验证码为: <span style="font-size: 200%; color: red;"> :code </span> (该验证码仅在24小时内使用有效，24小时后请重新进行该账户信息修改操作流程。)',
        'footer'  => '如果当前操作非您本人，请立即修改账户密码',
        'tip'     => '小提示：绑定邮箱后，您可以更加方便、安全的修改个人资料、找回密码等操作。此为系统自动发送，请勿回复。工作人员不会向你索取此验证码，请勿泄漏。'
    ],
    'password_reset'              => [
        'subject' => '【:app_name】重置密码通知',
        'button' => '重置密码',
        'email_tip' => '您之所以收到此电子邮件，是因为我们收到了您帐户的密码重置请求',
        'expire_tip' => "此密码重置链接将在 :count 分钟后过期",
        'action_tip' => '如果您没有请求密码重置，则不需要进一步操作',
        'error_tip' => '如果您在单击" :actionText "该按钮时遇到问题,请复制并粘贴下面的URL到您的Web浏览器'
    ],
    'password_reset_success' => [
        'subject' => '【:app_name】修改密码成功'
    ],
    'reset_password' => '重置密码'
];

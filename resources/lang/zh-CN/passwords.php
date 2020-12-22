<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password' => '密码必须至少为六个字符，并且与确认密码一致.',
    'reset'    => [
        'mail_subject' => '账户密码重置邮件',
        'mail_title'   => '请点击以下链接，完成您账户的密码重置。(该链接仅在24小时内访问有效，24小时后请重新进行该账户的重置操作流程。)',
        'mail_footer'  => '如果以上链接无法访问，请将该网址复制并粘贴至浏览器窗口中直接访问。',
    ],
    'sent'     => '我们已通过电子邮件发送了您的密码重置链接!',
    'token'    => '密码重置令牌无效.',
    'user'     => "我们找不到使用该电子邮件地址的用户.",

];

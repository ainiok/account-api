<?php
/**
 * Created by PhpStorm.
 * User: chenglong
 * Date: 2016/3/5
 * Time: 15:16
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
    'no_authorized'         => "当前用户未登录",
    'old_password_error'    => '原密码输入错误',
    'edit_password_error'   => '修改密码失败，错误原因【:code】',
    'edit_user_basic_error' => '修改账号信息失败，错误原因【:code】',
    'mail_reset'            => [
        'expired'     => '密码重置会话超时，请刷新页面',
        'code_error'  => '邮箱验证码错误',
        'subject'     => '账户信息修改邮件',
        'mail_title'  => '您正在进行账户信息修改操作,本次的验证码为 :code (该验证码仅在24小时内使用有效，24小时后请重新进行该账户信息修改操作流程)',
        'mail_footer' => '如果当前操作非您本人，请立即登录官网修改账户密码'
    ],
    'mail_activation'       => [
        'expired'       => '邮箱激活会话超时，请刷新页面',
        'step_invalid'  => '当前操作步骤无效,请重新进行操作',
        'token_invalid' => '当前激活会话无效，请重新进行激活操作',
        'subject'       => '账户邮箱激活邮件',
        'mail_title'    => '请点击以下链接，完成您账户的邮箱激活。(该链接仅在24小时内访问有效，24小时后请重新进行该账户的邮箱激活操作流程)',
        'mail_footer'   => '如果当前操作非您本人，请立即登录官网修改账户密码'
    ],
    'delete'                => [
        'error' => '用户删除失败，请重试或者联系客服处理'
    ],
    'no_phone'              => '当前用户无手机号码',
    'expire_probation'      => '创建用户失败，申请试用期已过，请联系xyclouds客服处理'
];

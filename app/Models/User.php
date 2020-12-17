<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'forbidden'         => 'boolean',
        'second_auth'       => 'boolean'
    ];

    /**
     * 关联用户登录历史
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function loginHistories()
    {
        return $this->morphMany(LoginHistory::class, 'user');
    }

    /**
     * 密码加密
     *
     * @param $value string
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt(md5($value));
    }
}

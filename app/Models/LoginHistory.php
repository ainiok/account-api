<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'platform',
        'device',
        'login_name',
        'status',
        'msg',
    ];

    /**
     * 返回值中隐藏字段
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'user_id',
        'user_type',
    ];

    /**
     * 关联用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

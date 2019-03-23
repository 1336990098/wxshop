<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    //
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * 与模型关联的数据表的主键。
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * 执行模型是否自动维护时间戳.
     *
     * @var bool
     */
    public $timestamps = false;
}

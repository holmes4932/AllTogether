<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

final class Groups extends Model
{
    //use HasApiTokens, HasFactory, Notifiable;

    /**
     * 此模型的連接名稱
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * 與模型關聯的資料表
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * 模型的主鍵
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 不可大量分配的属性
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 指示ID是否自動遞增
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * 指定是否模型應該被戳記時間
     *
     * @var bool
     */
    public $timestamps = true;
    
}

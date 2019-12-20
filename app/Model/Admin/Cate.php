<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class cate extends Model
{
    protected $table    = 'Cate';
    protected $primaryKey = 'c_id';
    public $timestamps = false;
    //protected $fillable = ['name'];//允许被批量赋值
    protected $guarded = [];//不允许被批量赋值
}

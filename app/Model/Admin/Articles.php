<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table    = 'articles';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //protected $fillable = ['name'];//允许被批量赋值
    protected $guarded = [];//不允许被批量赋值
}

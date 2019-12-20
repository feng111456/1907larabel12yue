<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class Order_address extends Model
{
    protected $table    = 'order_address';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //protected $fillable = ['name'];//允许被批量赋值
    protected $guarded = [];//不允许被批量赋值
}

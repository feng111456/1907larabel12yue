<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table    = 'address';
    protected $primaryKey = 'address_id';
    public $timestamps = false;
    //protected $fillable = ['name'];//允许被批量赋值
    protected $guarded = [];//不允许被批量赋值
}

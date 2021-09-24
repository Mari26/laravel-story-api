<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','type_id','name','code','price','productiontime','productionperiod'];

    public static function create(array $validated)
    {
    }


}

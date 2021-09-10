<?php

namespace App\Models;

use App\Models\Provider;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','type_id','name','code','price','productiontime','productionperiod'];

    public function providers()
    {
        return $this->belongsTo(Provider::class);
    }
//    public function types()
//    {
//        return $this->belongsTo(Types::class);
//    }
}

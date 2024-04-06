<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name','category_name','number','amount','place','purchase_date','purchase_from','category_id','image_path','use','unnecessary','disuse_month'
    ];
    protected $guarded = [
        'id',
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function itemUsageHistories(){
        return $this->hasMany('App\ItemUsageHistory');
    }
    public function latestItemUsageHistory(){
        return $this->hasOne('App\ItemUsageHistory')->orderBy('use_at','desc');
    }
}

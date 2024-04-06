<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemUsageHistory extends Model
{
    protected $fillable = [
    'item_id'
    ];
    public function item(){
        return $this->belongsTo('App\Item');
    }
}

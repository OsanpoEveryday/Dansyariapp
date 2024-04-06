<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'text'
    ];
    protected $guarded = [
        'id',
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }
}

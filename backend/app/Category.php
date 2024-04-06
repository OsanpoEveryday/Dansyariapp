<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name','user_id'
    ];
    protected $guarded = [
        'id',
    ];
    public function wants(){
        return $this->hasMany('App\Want');
    }
    public function rules(){
        return $this->hasMany('App\Rule');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
};

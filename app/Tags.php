<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'tags';

    protected $guarded = [];

    public function articles(){
        return $this->belongsToMany('App\Articles');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    public function articles(){
        return $this->belongsToMany('App\Articles');
    }
}

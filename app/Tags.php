<?php

namespace App;

use App\Facade\CleanString;
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


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($tag) {
            $text = strtolower(htmlentities($tag->name));
            $text = str_replace(" ", "-", $text);

            $tag->code = CleanString::removeAccents($text);
        });
    }
}

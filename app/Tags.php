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
            $text = str_replace(array('[\', \']'), '', $tag->name);
            $text = preg_replace('/\[.*\]/U', '', $text);
            $text = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $text);
            $text = htmlentities($text, ENT_COMPAT, 'utf-8');
            $text = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $text );
            $text = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $text);
            $text = trim($text, '-');
            $tag->code = CleanString::removeAccents($text);
        });
    }
}

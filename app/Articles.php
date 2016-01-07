<?php

namespace App;

use App\Facade\CleanString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use SoftDeletes;

    protected $table = 'articles';
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getUpdatedAtAttribute($value)
    {
        $value = date('j.n.Y', strtotime($value));
        return $value;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tags');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    /**
     * Vracia id kategorii spojenych s produktom
     * @return array
     */
    public function tags_id()
    {
        return $this->tags->lists('id')->all();
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {
            $text = strtolower(htmlentities($article->title));
            $text = str_replace(" ", "-", $text);
            $article->code = CleanString::removeAccents($text);
        });
    }
}

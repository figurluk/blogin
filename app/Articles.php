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

        static::deleting(function ($article) {
            $article->tags()->detach();
        });

        static::saving(function ($article) {
            $text = str_replace(array('[\', \']'), '', $article->title);
            $text = preg_replace('/\[.*\]/U', '', $text);
            $text = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $text);
            $text = htmlentities($text, ENT_COMPAT, 'utf-8');
            $text = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $text );
            $text = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $text);
            $text = trim($text, '-');
            $article->code = CleanString::removeAccents($text);
        });
    }
}

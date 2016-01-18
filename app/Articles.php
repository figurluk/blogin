<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App;

use App\Facade\CleanString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Articles
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App
 */
class Articles extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @var string
     */
    protected $table = 'articles';
    /**
     * @var array column deleted_at fort soft deleting
     * @author Lukas Figura <figurluk@gmail.com>
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array columns which can not be accessed
     * @author Lukas Figura <figurluk@gmail.com>
     */
    protected $guarded = [];

    /**
     * Method format value of column updated_at when it is accessed
     *
     * @param string $value value from column updated_at of specific Article
     * @author Lukas Figura <figurluk@gmail.com>
     * @return string formatted $value
     */
    public function getUpdatedAtAttribute($value)
    {
        $value = date('j.n.Y', strtotime($value));
        return $value;
    }

    /**
     * Method format value of column created_at when it is accessed
     *
     * @param string $value value from column created_at of specific Article
     * @author Lukas Figura <figurluk@gmail.com>
     * @return string formatted $value
     */
    public function getCreatedAtAttribute($value)
    {
        $value = date('j.n.Y', strtotime($value));
        return $value;
    }

    /**
     * Method return user which created Article
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Method return array of Tags attached to Article
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tags');
    }

    /**
     * Method return array of Comments attached to Article
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    /**
     * Method return array of Tags id's attached to Article
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return mixed
     */
    public function tags_id()
    {
        return $this->tags->lists('id')->all();
    }

    /**
     * The "booting" method of the model.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Method called when deleting Article
         * @author Lukas Figura <figurluk@gmail.com>
         */
        static::deleting(function ($article) {
            $article->tags()->detach();
        });

        /**
         * Method called when saving Article
         * @author Lukas Figura <figurluk@gmail.com>
         */
        static::saving(function ($article) {
            $text = str_replace(array('[\', \']'), '', $article->title);
            $text = preg_replace('/\[.*\]/U', '', $text);
            $text = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $text);
            $text = htmlentities($text, ENT_COMPAT, 'utf-8');
            $text = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $text);
            $text = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $text);
            $text = trim($text, '-');
            $article->code = CleanString::removeAccents($text);
        });
    }
}

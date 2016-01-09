<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App;

use App\Facade\CleanString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tags
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App
 */
class Tags extends Model
{
    use SoftDeletes;
    /**
     * @var array column deleted_at fort soft deleting
     * @author Lukas Figura <figurluk@gmail.com>
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array columns which can not be accessed
     * @author Lukas Figura <figurluk@gmail.com>
     */
    protected $guarded = [];

    /**
     * Method return Array of Articles which are attached to Tag
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Articles');
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
         * Method called when saving Tag
         * @author Lukas Figura <figurluk@gmail.com>
         */
        static::saving(function ($tag) {
            $text = str_replace(array('[\', \']'), '', $tag->name);
            $text = preg_replace('/\[.*\]/U', '', $text);
            $text = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $text);
            $text = htmlentities($text, ENT_COMPAT, 'utf-8');
            $text = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $text);
            $text = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $text);
            $text = trim($text, '-');
            $tag->code = CleanString::removeAccents($text);
        });
    }
}

<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comments
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App
 */
class Comments extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @var string
     */
    protected $table = 'comments';
    /**
     * @var array columns which can not be accessed
     * @author Lukas Figura <figurluk@gmail.com>
     */
    protected $guarded = [];
    /**
     * @var array column deleted_at fort soft deleting
     * @author Lukas Figura <figurluk@gmail.com>
     */
    protected $dates = ['deleted_at'];

    /**
     * Method format value of column created_at when it is accessed
     *
     * @param string $value value from column created_at of specific Comment
     * @author Lukas Figura <figurluk@gmail.com>
     * @return string formatted $value
     */
    public function getCreatedAtAttribute($value)
    {
        $value = date('j.n.Y H:i:s', strtotime($value));
        return $value;
    }

    /**
     * Method return Article which contains Comment
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articles()
    {
        return $this->belongsTo('App\Articles');
    }

    /**
     * Method return User which created Comment
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Method return Array of Comments attached to Comment
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comments', 'comments_id', 'id');
    }

    /**
     * Method return Comment which contains Comment
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belongComments()
    {
        return $this->belongsTo('App\Comments');
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
         * Method called when deleting Comment
         * @author Lukas Figura <figurluk@gmail.com>
         */
        static::deleting(function ($comment) {
            $comment->comments()->delete();
        });

    }
}

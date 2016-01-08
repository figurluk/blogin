<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function getCreatedAtAttribute($value)
    {
        $value = date('j.n.Y H:i:s', strtotime($value));
        return $value;
    }

    public function articles()
    {
        return $this->belongsTo('App\Articles');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments','comments_id','id');
    }

    public function belongComments(){
        return $this->belongsTo('App\Comments');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($comment) {
            $comment->comments()->delete();
        });

    }
}

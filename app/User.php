<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App
 */
class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @var string
     */
    protected $table = 'users';
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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Method return Array of Articles created by User
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Articles');
    }

    /**
     * Method return Array of Comments created by User
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}

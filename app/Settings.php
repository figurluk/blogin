<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Settings
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App
 */
class Settings extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @var string
     */
    protected $table = 'settings';
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
}

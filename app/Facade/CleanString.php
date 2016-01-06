<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 03.12.15
 * Time: 10:14
 */

namespace app\Facade;


use Illuminate\Support\Facades\Facade;

class CleanString extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cleanstring';
    }
}
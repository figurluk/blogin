<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 03.12.15
 * Time: 10:14
 */

namespace app\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class CleanString
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Facade
 */
class CleanString extends Facade
{
    /**
     * Facade accessor
     * @return string name of class
     */
    protected static function getFacadeAccessor()
    {
        return 'cleanstring';
    }
}
<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Jobs;

use Illuminate\Bus\Queueable;

/**
 * Class Job
 * @package App\Jobs
 */
abstract class Job
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "onQueue" and "delay" queue helper methods.
    |
    */

    use Queueable;
}

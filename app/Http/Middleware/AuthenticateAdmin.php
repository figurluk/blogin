<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class AuthenticateAdmin
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Middleware
 */
class AuthenticateAdmin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/auth/login');
            }
        }
        elseif (!$this->auth->guest() && $this->auth->user()->admin!=1){
            flash()->warning('Nieste oprávnený pre vstup do administračnej časti.');
            return redirect()->action('Blog\HomeController@index');
        }

        return $next($request);
    }
}

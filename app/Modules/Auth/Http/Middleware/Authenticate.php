<?php

namespace Snijenhuis\Modules\Auth\Http\Middleware;

use Cartalyst\Sentinel\Sentinel;
use Closure;

class Authenticate
{
    public function __construct(Sentinel $sentinel){
        $this->sentinel = $sentinel;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->sentinel->guest()) {
            return redirect()->route('auth.login.get');
        }

        return $next($request);
    }
}

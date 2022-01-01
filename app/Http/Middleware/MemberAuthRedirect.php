<?php

namespace App\Http\Middleware;

use App\Libraries\MemberAuth;
use Closure;
use Illuminate\Http\Request;

class MemberAuthRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!MemberAuth::isLoggedIn()){
            return redirect()->route('member.session.create');
        }
        return $next($request);
    }
}

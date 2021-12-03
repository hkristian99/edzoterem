<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserRole;

class isNotVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( !Auth::check() )
            return redirect()->route("login");

        if(Auth::user()->status == 3)
            return redirect()->route("PasswordStatus");   

        $userRole = UserRole::where("user_id",Auth::user()->id)
                            ->whereIn("role_id",[1,2,3,5])
                            ->count();

        if ( $userRole==0 )
            return redirect()->route("home");

        return $next($request);
    }
}

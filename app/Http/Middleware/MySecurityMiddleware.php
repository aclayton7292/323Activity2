<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Services\Utility\MyLogger2;

class MySecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        MyLogger2::info("Entering My Security Middleware in handle() at path: " . $path);
        
        $secureCheck = true;
        if($request->is('login5') || $request->is('showUsers') || $request->is('dologin3') || $request->is('registerUser') || $request->is('showAllUsers') || $request->is('doRegister')){
            $secureCheck = false;
        }
        MyLogger2::info($secureCheck ? "Security middleware in handle()...........Needs Security" : 
                                            "Security Middleware in handle()........No Security Needed");
        
        //can be used to see if the session is set or not
        $enable = true;
        if($enable && $secureCheck){
            MyLogger2::info("Leaving My Security Middleware in handle() doing a redirect back to login");
            return redirect('/login5');
        }
        
        return $next($request);
    }
}

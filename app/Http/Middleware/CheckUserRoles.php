<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class CheckUserRoles
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
        if($request->user() === null)
          return redirect("login");

        $request_params = $request->route()->getAction();
        //$roles = isset($request_params["user_roles"])?$request_params["user_roles"]:null;
        $permissions = isset($request_params["user_permissions"])?$request_params["user_permissions"]:null;

        if($request->user()->AllowToPath($permissions))
          return $next($request);

          return redirect("nopermission");
    }
}

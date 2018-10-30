<?php

namespace App\Http\Middleware;
use App\settings;
use Closure;

class checklanguage
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
        $lang = isset($request->lang)?$request->lang:"ar";
        if($request->query("lang") != null)
          $lang = $request->query("lang");


        app()->setLocale($lang);

        if($request->user()->currency == null)
         $request->user()->currency = settings::find(1)->currency;
         
        return $next($request);
    }
}

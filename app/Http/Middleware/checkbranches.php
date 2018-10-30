<?php

namespace App\Http\Middleware;

use Closure;

class checkbranches
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
        $branches_ids = !$request->user()->IsAdmin() ? $request->user()->getBranchesIds():$request->user()->getAdminBranchesIds();
        $branches_data = !$request->user()->IsAdmin() ?$request->user()->branche: \App\branch::all();


        $request->user()->branches = $request->has('branch') && !empty($request->query("branch"))?array(intval($request->query("branch"))):$branches_ids;
        $request->user()->active_branch = $request->has('branch') && !empty($request->query("branch"))?intval($request->query("branch")):$branches_data;
        return $next($request);
    }
}

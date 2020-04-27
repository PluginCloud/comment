<?php

namespace PluginCloud\Comment\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSessionMiddleware
{
    public function handle(Request $request, Closure $next, $is_login = "true")
    {
        if ($is_login == "true") {
            if ($request->session()->has("comment_user")) {
                return $next($request);
            }else {
                return redirect()->route("comment.home.user.login");
            }
        }else {
            if (!$request->session()->has("comment_user")) {
                return $next($request);
            }else {
                return back();
            }
        }

    }
}

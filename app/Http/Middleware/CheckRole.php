<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $category_id, $role)
    {
        $user = Auth::guard('api')->user();
        if ($user && $user->checkRole($category_id, $role)) {
            return $next($request);
        }
        return response()->json(['error' => 'Bạn không có quyền truy cập'], 403);
    }
}

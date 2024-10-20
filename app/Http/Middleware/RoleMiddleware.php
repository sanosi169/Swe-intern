<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // تأكد من إضافة هذا السطر
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // التحقق مما إذا كان المستخدم مسجل الدخول أم لا
        if (!Auth::check()) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        // التحقق مما إذا كان المستخدم لديه الصلاحية المطلوبة
        if (Auth::user()->role ===$role) {
            return $next($request);
        }

        // إذا كان المستخدم لا يملك الصلاحية المناسبة
        return response()->json(['error' => 'No permission'], 403);
    }
}

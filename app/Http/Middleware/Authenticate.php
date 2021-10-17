<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class Authenticate
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
        $users = User::query()->where(
            [
                'id' => $request->header('id'),
                'token' => $request->header('token')
            ]
        )->get();

        if (count($users) === 0) {
            abort(401, 'Nein!');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckCorretor
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
        $id = Auth::id();

        $dados = DB::table('users')->select('users.tipo_user_id')->where('users.tipo_user_id', '=', 2)->where('users.id', '=', $id)->value('users.tipo_user_id');

        if($dados == 2){
            return $next($request);
        }else{
            return redirect(route('home'));
        }
    }
}

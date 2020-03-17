<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $idUsuario = Auth::user()->id;

        $tipoUser = DB::table('users')->select('users.tipo_user_id')->where('users.id', '=', $idUsuario)->value('users.tipo_user_id');

        if ($tipoUser == 1){
            //admin
            return redirect()->route('admin.index');
        }elseif ($tipoUser == 2){
            return redirect()->route('corretor.index');
        }elseif ($tipoUser == 4){
            return redirect()->route('administrativo.index');
        }
    }
}

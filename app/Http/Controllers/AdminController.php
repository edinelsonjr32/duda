<?php

namespace App\Http\Controllers;

use App\Imovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUsuario = Auth::user()->id;
        $imoveis = DB::table('imovel')->select('imovel.*')->where('user_id', '=', $idUsuario)->count();

        $tipoUser = DB::table('users')->select('users.tipo_user_id')->where('users.id', '=', $idUsuario)->value('users.tipo_user_id');

        $horrio = date("Y/m/d");
        $minhasVisitas = DB::table('visitas')->select('visitas.*', 'users.name as nome')->join('users', 'visitas.users_id', '=', 'users.id')->where('visitas.users_id', '=', $idUsuario)->where('visitas.data', '=', $horrio)->paginate(10);

        if ($tipoUser == 1){
            //admin
            return view('admin.index', ['imoveis'=> $imoveis, 'minhasVisitas' => $minhasVisitas]);
        }elseif ($tipoUser == 2){
            return view('corretor.index', ['imoveis'=> $imoveis , 'minhasVisitas' => $minhasVisitas]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

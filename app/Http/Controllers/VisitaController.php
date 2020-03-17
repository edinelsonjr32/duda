<?php

namespace App\Http\Controllers;

use App\Imovel;
use App\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $horrio = date("Y/m/d");

        $visitas = DB::table('visitas')->select('visitas.*', 'users.name as nome')->join('users', 'visitas.users_id', '=', 'users.id')->where('visitas.data', '=', $horrio)->get();
        $nomeCadastrado = DB::table('visitas')->select('users.name as nome2')->join('users', 'visitas.usuario_log', '=', 'users.id')->where('visitas.usuario_log', '=', Auth::user()->id)->where('visitas.data', '=', $horrio)->get();


        $imoveis = DB::table('imovel')->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel_imagem.principal', '=', 1)->paginate(10);

        $users = DB::table('users')->select('users.name as nome', 'users.id')->get();



        $visitasTotais = DB::table('visitas')->select('visitas.*', 'users.name as nome')->join('users', 'visitas.users_id', '=', 'users.id')->where('visitas.data', '!=', $horrio)->paginate(10);

        $idUsuario = Auth::user()->id;


        $minhasVisitas = DB::table('visitas')->select('visitas.*', 'users.name as nome')->join('users', 'visitas.users_id', '=', 'users.id')->where('visitas.users_id', '=', $idUsuario)->paginate(10);







        return view('admin.visita.index', ['visitas' => $visitas, 'minhasVisitas'=> $minhasVisitas, 'visitasTotais' => $visitasTotais, 'users' => $users, 'imoveis'=>$imoveis]);
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


        $hora = date('H:i:s', strtotime($request->hora));
        $data = date('d/m/Y', strtotime($request->data));
        $usuario_log = Auth::user()->id;

        $validatedData = $request->validate(
            [
                'users_id' => ['required'],
                'imovel_id' => ['required'],
                'hora' => ['required'],
                'data' => ['required'],
            ]
        );
        $visita = new Visita();
        $visita->data = $request->data;
        $visita->hora = $hora;
        $visita->users_id = $request->users_id;
        $visita->imovel_id = $request->imovel_id;
        $visita->status = true;
        $visita->usuario_log = $usuario_log;

        if ($visita->save()){
            return redirect()->route('visita.index')->with(['class-color' => 'alert-success', 'message' => 'Visita cadastrada com sucesso!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show($visita)
    {
        $dados = DB::table('visitas')->select('visitas.*', 'users.name as nome', 'imovel.*')->join('users', 'users.id', '=', 'visitas.users_id')->join('imovel', 'imovel.id', '=', 'visitas.imovel_id')->where('visitas.id', '=', $visita)->get();

        $dados2 = DB::table('visitas')->select( 'users.name as nomeUser')->join('users', 'users.id', '=', 'visitas.usuario_log')->where('visitas.id', '=', $visita)->get();





        return view('admin.visita.detail', ['dados' => $dados, 'dados2' => $dados2]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Visita $visita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visita $visita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy( $visita)
    {
        $visita = Visita::find($visita);
        $visita->delete();

        return redirect()->route('visita.index')->with(['class-color' => 'alert-success', 'message' => 'Usuário removido com sucesso!']);
    }
}

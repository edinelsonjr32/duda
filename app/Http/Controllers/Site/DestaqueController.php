<?php

namespace App\Http\Controllers\Site;

use App\Destaque;
use App\Imovel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DestaqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destaques = DB::table('imovel')->select('destaque.id as idDestaque', 'destaque.status as status','imovel.titulo', 'imovel.id as idImovel', 'imovel_imagem.path') ->join('destaque', 'destaque.imovel_id', '=', 'imovel.id')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel_imagem.principal' , '=', 1)->get();

        return view('admin.imovel.destaque', ['destaques' => $destaques]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $imoveis = Imovel::all();

        return view('admin.imovel.destaque_create', ['imoveis'=> $imoveis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idImovel = $request->imovel_id;

        $destaque = new Destaque();
        $destaque->imovel_id = $idImovel;
        $destaque->status = true;

        if ($destaque->save()){
            return redirect()->route('admin.imoveis.destaque')->with(['class-color' => 'alert-success', 'message' => 'Destaque cadastrado com sucesso!']);
        }else{
            return redirect()->route('admin.imoveis.destaque')->with(['class-color' => 'alert-danger', 'message' => 'Erro no cadastro de destaque!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Destaque  $destaque
     * @return \Illuminate\Http\Response
     */
    public function show(Destaque $destaque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Destaque  $destaque
     * @return \Illuminate\Http\Response
     */
    public function edit(Destaque $destaque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Destaque  $destaque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destaque $destaque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Destaque  $destaque
     * @return \Illuminate\Http\Response
     */
    public function destroy($destaque)
    {
        $destaques = Destaque::find($destaque);

        if ($destaques->delete()){
            return redirect()->route('admin.imoveis.destaque');
        }else{
            return redirect()->route('admin.imoveis.destaque');
        }

    }
}

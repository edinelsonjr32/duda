<?php

namespace App\Http\Controllers\Admin;

use App\Imovel;
use App\TipoImovel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TipoImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dadosProprietario = TipoImovel::all();
        return view('admin.tipoImovel.index', ['dadosProprietario' => $dadosProprietario]);
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
        $tipoImovel = new TipoImovel();

        $tipoImovel->nome = $request->nome;

        if ($tipoImovel->save()){
            return redirect()->route('tipo_imovel.index')->with(['class-color' => 'alert-success', 'message' => 'Tipo Imóvel Adicionado com sucesso!']);
        }
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
    public function delete($id)
    {
        $dadosTiposImoveis = DB::table('imovel')->select('imovel.*')->where('imovel.tipo_imovel', '=', $id)->get();

        if ($dadosTiposImoveis == "[]"){
            $tipoImovel = TipoImovel::destroy($id);

            return redirect()->route('tipo_imovel.index')->with(['class-color' => 'alert-success', 'message' => 'Tipo Imóvel removido com sucesso!']);;
        }elseif ($dadosTiposImoveis !== "[]"){

            return redirect()->route('tipo_imovel.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na remoção de Tipo Imóvel, existem imóveis cadastrado com esse tipo!']);;
        }

    }
}

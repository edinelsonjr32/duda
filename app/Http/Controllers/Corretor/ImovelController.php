<?php

namespace App\Http\Controllers\Corretor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexVenda()
    {
        $dadosImoveis = DB::table('imovel')
            ->select(
                'imovel.*' ,
                'imovel_imagem.path as path',
                'tipo_imovel.nome as nomeTipoImovel',
                'proprietario.nome as nomeProprietario'
            )->join('proprietario', 'proprietario.id', '=', 'imovel.proprietario_id')
            ->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')
            ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
            ->where('imovel.venda', '=', 1)
            ->where('imovel_imagem.principal', '=', 1)
            ->get();



        return view('corretor.imovel.venda.index', ['dadosImoveis' =>$dadosImoveis]);
    }


    public function indexAluguel()
    {
        $dadosImoveis = DB::table('imovel')
            ->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel','proprietario.nome as nomeProprietario')->join('proprietario', 'proprietario.id', '=', 'imovel.proprietario_id')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel.aluguel', '=', 1)->where('imovel_imagem.principal', '=', 1)->get();


        return view('corretor.imovel.aluguel.index', ['dadosImoveis' =>$dadosImoveis]);
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
    public function detailVenda($id)
    {
        $dadosImovel = DB::table('imovel')
            ->select('imovel.*','imovel.id as idImovel', 'proprietario.nome', 'tipo_imovel.nome as nomeTipo', 'users.name as nomeCorretor')
            ->join('users', 'users.id', '=', 'imovel.user_id')
            ->join('proprietario', 'proprietario.id', '=' ,'imovel.proprietario_id')
            ->join('tipo_imovel', 'tipo_imovel.id', '=' ,'imovel.tipo_imovel')
            ->where('imovel.id', '=', $id)
            ->get();


        $users = DB::table('users')->select('users.name as nome', 'users.id')->get();


        if ($dadosImovel == '[]'){
            return redirect()->route('corretor.imoveis.venda.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na busca de Imóvel, tente novamente!']);
        }else{


            $imagensImoveis = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->get();
            $contador1 = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->count();


            //$imagensImoveisNoActive = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->where('imovel_imagem.principal', '=', 0)->get();

            //return $imagensImoveisNoActive;

            return view(
                'corretor.imovel.venda.detail',
                [
                    'dadosImovel' => $dadosImovel,
                    'imagensImoveis' => $imagensImoveis,
                    'contador1' => $contador1,
                    'users' => $users

                ]);
        }
    }


    public function detailAluguel($id)
    {
        $dadosImovel = DB::table('imovel')
            ->select('imovel.*','imovel.id as idImovel', 'proprietario.nome', 'tipo_imovel.nome as nomeTipo', 'users.name as nomeCorretor')
            ->join('users', 'users.id', '=', 'imovel.user_id')
            ->join('proprietario', 'proprietario.id', '=' ,'imovel.proprietario_id')
            ->join('tipo_imovel', 'tipo_imovel.id', '=' ,'imovel.tipo_imovel')
            ->where('imovel.id', '=', $id)
            ->get();


        $users = DB::table('users')->select('users.name as nome', 'users.id')->get();


        if ($dadosImovel == '[]'){
            return redirect()->route('corretor.imoveis.aluguel.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na busca de Imóvel, tente novamente!']);
        }else{


            $imagensImoveis = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->get();
            $contador1 = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->count();


            //$imagensImoveisNoActive = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->where('imovel_imagem.principal', '=', 0)->get();

            //return $imagensImoveisNoActive;

            return view(
                'corretor.imovel.aluguel.detail',
                [
                    'dadosImovel' => $dadosImovel,
                    'imagensImoveis' => $imagensImoveis,
                    'contador1' => $contador1,
                    'users' => $users

                ]);
        }
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

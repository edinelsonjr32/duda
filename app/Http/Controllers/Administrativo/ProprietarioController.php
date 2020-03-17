<?php

namespace App\Http\Controllers\Administrativo;

use App\DocumentoProprietario;
use App\Proprietario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProprietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJuridico()
    {

        // =  DB::select()->join('tipo_proprietario')->where('proprietario.tipo_proprietario_id', '=', 'tipo_proprietario.id')->get();

        $dadosProprietarios = DB::table('proprietario')
            ->select('proprietario.*', 'tipo_proprietario.nome as nomeTipo', 'users.name')
            ->join('tipo_proprietario', function($join){
                $join->on('tipo_proprietario.id', '=', 'proprietario.tipo_proprietario_id');
            })
            ->join('users','users.id', '=', 'proprietario.usuario_id')
            ->where('proprietario.tipo_proprietario_id', '=', 2)
            ->orderby('proprietario.id', 'ASC')
            ->get();

        return view('administrativo.proprietario.juridica.index', ['dados' => $dadosProprietarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createJuridico()
    {
        return view('administrativo.proprietario.juridica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJuridico(Request $request)
    {


        $usuarioId = Auth::user()->id;



        if(
        Proprietario::create(
            [
                'nome' => $request->nome,
                'tipo_proprietario_id' => $request->tipo_proprietario_id,
                'telefone' => $request->telefone,
                'rua' => $request->rua,
                'bairro' => $request->bairro,
                'usuario_id' => $usuarioId,
                'profissao' => $request->profissao,
                'nacionalidade' => $request->nacionalidade,
                'tipo_conta' => $request->tipo_conta,
                'variacao_poupanca' => $request->variacao_poupanca,
                'cep' => $request->cep,
                'banco' => $request->banco,
                'agencia' => $request->agencia,
                'conta' => $request->conta,
                'data_nascimento' => $request->data_nascimento,
                'cidade' => $request->cidade,
                'numero_casa' => $request->numero_casa,
                'estado' => $request->estado,
                'estado_civil' => $request->estado_civil,
                'cpf' => $request->cpf,
                'cnpj' => $request->cnpj,
                'nome_fantasia' => $request->nome_fantasia,
                'nome_empresa' => $request->nome_empresa,
                'orgao_emissor' => $request->orgao_emissor,
                'contrato_social' => $request->contrato_social,
                'email' => $request->email,
                'rg' => $request->rg
            ]
        )
        ){
            return redirect(route('administrativo.proprietario.juridico.index'))->with(['class-color' => 'alert-success', 'message' => 'Proprietário cadastrado com sucesso!']);
        }else{
            return redirect(route('administrativo.proprietario.juridico.index'))->with(['class-color' => 'alert-danger', 'message' => 'Erro no cadastro de Proprietário!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalheJuridico($id)
    {

        $proprietario = Proprietario::find($id);
        $documentos = DB::table('documentos_proprietario')->select('documentos_proprietario.*')->where('documentos_proprietario.proprietario_id', '=', $id)->get();


        $imoveisVenda = DB::table('imovel')->select('imovel.*')->where('imovel.proprietario_id', '=', $id)->where('imovel.venda', '=', 1)->get();

        $imoveisAluguel = DB::table('imovel')->select('imovel.*')->where('imovel.proprietario_id', '=', $id)->where('imovel.aluguel', '=', 1)->get();


        return view('administrativo.proprietario.juridica.detail', ['proprietario' => $proprietario, 'documentos' => $documentos, 'imoveisVenda' => $imoveisVenda, 'imoveisAluguel'=> $imoveisAluguel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editJuridico($id)
    {
        $dadosProprietario = Proprietario::where('id', $id)->first();


        return  view('administrativo.proprietario.juridica.edit', ['dadosProprietario' => $dadosProprietario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJuridico(Request $request, $id)
    {
        $dados = Proprietario::where('id', $id)->first();

        $dados->fill($request->all());



        if(!$dados->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('administrativo.proprietario.juridico.index')->with(['class-color' => 'alert-success', 'message' => 'proprietário atualizado com sucesso!']);
    }

    public function documentoDownloadJuridico($id)
    {
        $nomePath = DB::table('documentos_proprietario')->select('documentos_proprietario.path')->where('documentos_proprietario.id', '=', $id)->value('documentos_proprietario.id');

        //para fazer download de arquivo
        $pathToFile = public_path($nomePath);
        return response()->download($pathToFile);
    }


    public function documentoDeleteJuridico($id)
    {
        $documento = DocumentoProprietario::find($id);

        $nomePath = $documento->path;
        $idProprietario = $documento->proprietario_id;


        if ($documento->delete()){
            Storage::disk('public')->delete($nomePath);
            return redirect()->route('administrativo.proprietario.juridico.detalhe', $idProprietario)->with(['class-color' => 'alert-success', 'message' => 'imóvel  cadastrado com sucesso!']);
        }
    }
    public function documentoStoreJuridico( Request $request)
    {

        $idImovel = $request->proprietario_id;
        $images=array();

        if($files=$request->file('images')){

            foreach($files as $file){
                $name= str_replace(' ', '_', $request->nome) . '.'.$file->getClientOriginalExtension();
                $file->move('storage/proprietario/documentos/' . $idImovel ,$name);
                $images[]=$name;
                /*Insert your data*/
                $imagemImovel = new DocumentoProprietario();
                $imagemImovel->path = 'storage/proprietario/documentos/'. $idImovel . '/'. $name;
                $imagemImovel->nome = $name;
                $imagemImovel->proprietario_id = $idImovel;
                $imagemImovel->status = true;
                $imagemImovel->save();

            }
        }
        return redirect()->route('administrativo.proprietario.juridico.detalhe', $idImovel)->with(['class-color' => 'alert-success', 'message' => 'imóvel  cadastrado com sucesso!']);;


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyJuridico($id)
    {
        $proprietario = Proprietario::find($id);




        $documento = DB::table('documentos_proprietario')->where('documentos_proprietario.proprietario_id', '=', $id)->delete();

        if ($proprietario->delete()){

            return redirect()->route('administrativo.proprietario.juridico.index')->with(['class-color' => 'alert-success', 'message' => 'Proprietário removido com sucesso!']);
        }else{
            return redirect()->route('administrativo.proprietario.juridico.index')->with(['class-color' => 'alert-danger', 'message' => 'Proprietário não foi removido!']);
        }


    }











    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFisica()
    {

        // =  DB::select()->join('tipo_proprietario')->where('proprietario.tipo_proprietario_id', '=', 'tipo_proprietario.id')->get();

        $dadosProprietarios = DB::table('proprietario')
            ->select('proprietario.*', 'tipo_proprietario.nome as nomeTipo', 'users.name')
            ->join('tipo_proprietario', function($join){
                $join->on('tipo_proprietario.id', '=', 'proprietario.tipo_proprietario_id');
            })
            ->join('users','users.id', '=', 'proprietario.usuario_id')
            ->where('proprietario.tipo_proprietario_id', '=', 1)
            ->orderby('proprietario.id', 'ASC')
            ->get();

        return view('administrativo.proprietario.fisica.index', ['dados' => $dadosProprietarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFisica()
    {
        return view('administrativo.proprietario.fisica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFisica(Request $request)
    {


        $usuarioId = Auth::user()->id;



        if(
        Proprietario::create(
            [
                'nome' => $request->nome,
                'tipo_proprietario_id' => $request->tipo_proprietario_id,
                'telefone' => $request->telefone,
                'rua' => $request->rua,
                'bairro' => $request->bairro,
                'usuario_id' => $usuarioId,
                'profissao' => $request->profissao,
                'nacionalidade' => $request->nacionalidade,
                'tipo_conta' => $request->tipo_conta,
                'variacao_poupanca' => $request->variacao_poupanca,
                'cep' => $request->cep,
                'banco' => $request->banco,
                'agencia' => $request->agencia,
                'conta' => $request->conta,
                'data_nascimento' => $request->data_nascimento,
                'cidade' => $request->cidade,
                'numero_casa' => $request->numero_casa,
                'estado' => $request->estado,
                'estado_civil' => $request->estado_civil,
                'cpf' => $request->cpf,
                'cnpj' => $request->cnpj,
                'nome_fantasia' => $request->nome_fantasia,
                'nome_empresa' => $request->nome_empresa,
                'orgao_emissor' => $request->orgao_emissor,
                'contrato_social' => $request->contrato_social,
                'email' => $request->email,
                'rg' => $request->rg
            ]
        )
        ){
            return redirect(route('administrativo.proprietario.fisico.index'))->with(['class-color' => 'alert-success', 'message' => 'Proprietário cadastrado com sucesso!']);
        }else{
            return redirect(route('administrativo.proprietario.fisico.index'))->with(['class-color' => 'alert-danger', 'message' => 'Erro no cadastro de Proprietário!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalheFisica($id)
    {

        $proprietario = Proprietario::find($id);
        $documentos = DB::table('documentos_proprietario')->select('documentos_proprietario.*')->where('documentos_proprietario.proprietario_id', '=', $id)->get();


        $imoveisVenda = DB::table('imovel')->select('imovel.*')->where('imovel.proprietario_id', '=', $id)->where('imovel.venda', '=', 1)->get();

        $imoveisAluguel = DB::table('imovel')->select('imovel.*')->where('imovel.proprietario_id', '=', $id)->where('imovel.aluguel', '=', 1)->get();


        return view('corretor.proprietario.fisica.detail', ['proprietario' => $proprietario, 'documentos' => $documentos, 'imoveisVenda' => $imoveisVenda, 'imoveisAluguel'=> $imoveisAluguel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editFisica($id)
    {
        $dadosProprietario = Proprietario::where('id', $id)->first();


        return  view('administrativo.proprietario.fisica.edit', ['dadosProprietario' => $dadosProprietario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFisica(Request $request, $id)
    {
        $dados = Proprietario::where('id', $id)->first();

        $dados->fill($request->all());



        if(!$dados->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('administrativo.proprietario.fisico.index')->with(['class-color' => 'alert-success', 'message' => 'proprietário atualizado com sucesso!']);
    }

    public function documentoDownloadFisica($id)
    {
        $nomePath = DB::table('documentos_proprietario')->select('documentos_proprietario.path')->where('documentos_proprietario.id', '=', $id)->value('documentos_proprietario.id');

        //para fazer download de arquivo
        $pathToFile = public_path($nomePath);
        return response()->download($pathToFile);
    }


    public function documentoDeleteFisica($id)
    {
        $documento = DocumentoProprietario::find($id);

        $nomePath = $documento->path;
        $idProprietario = $documento->proprietario_id;


        if ($documento->delete()){
            Storage::disk('public')->delete($nomePath);
            return redirect()->route('administrativo.proprietario.fisico.detalhe', $idProprietario)->with(['class-color' => 'alert-success', 'message' => 'imóvel  cadastrado com sucesso!']);
        }
    }
    public function documentoStoreFisica( Request $request)
    {

        $idImovel = $request->proprietario_id;
        $images=array();

        if($files=$request->file('images')){

            foreach($files as $file){
                $name= str_replace(' ', '_', $request->nome) . '.'.$file->getClientOriginalExtension();
                $file->move('storage/proprietario/documentos/' . $idImovel ,$name);
                $images[]=$name;
                /*Insert your data*/
                $imagemImovel = new DocumentoProprietario();
                $imagemImovel->path = 'storage/proprietario/documentos/'. $idImovel . '/'. $name;
                $imagemImovel->nome = $name;
                $imagemImovel->proprietario_id = $idImovel;
                $imagemImovel->status = true;
                $imagemImovel->save();
            }
        }
        return redirect()->route('administrativo.proprietario.fisico.detalhe', $idImovel)->with(['class-color' => 'alert-success', 'message' => 'imóvel  cadastrado com sucesso!']);;


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFisica($id)
    {
        $proprietario = Proprietario::find($id);




        $documento = DB::table('documentos_proprietario')->where('documentos_proprietario.proprietario_id', '=', $id)->delete();

        if ($proprietario->delete()){

            return redirect()->route('administrativo.proprietario.fisico.index')->with(['class-color' => 'alert-success', 'message' => 'Proprietário removido com sucesso!']);
        }else{
            return redirect()->route('administrativo.proprietario.fisico.index')->with(['class-color' => 'alert-danger', 'message' => 'Proprietário não foi removido!']);
        }

    }
}

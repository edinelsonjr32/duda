<?php

namespace App\Http\Controllers;

use App\AnexoAutorizacaoLocacao;
use App\AutorizacaoLocacao;
use App\ImovelAutorizacaoLocacao;
use App\Proprietario;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AutorizacaoLocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autorizacoes = DB::table('autorizacao_locacao')->select('autorizacao_locacao.*', 'proprietario.nome', 'proprietario.tipo_proprietario_id', 'proprietario.nome_empresa')->join('proprietario', 'proprietario.id', '=', 'autorizacao_locacao.proprietarioId')->get();

        $proprietarios = Proprietario::all();

        return view('autorizacao.locacao.index', ['autorizacoes' => $autorizacoes, 'proprietarios'=> $proprietarios]);
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
    public function buscaImovel(Request $request)
    {
        $imoveisProprietario = DB::table('imovel')->select('imovel.id', 'imovel.titulo', 'imovel.valor_aluguel')->where('proprietario_id', '=', $request->proprietarioId)->where('imovel.aluguel', '=', 1)->get();

        $idProprietario = $request->proprietarioId;
        $dadosProprietarios = Proprietario::find($idProprietario);

        return view('autorizacao.locacao.busca', ['imoveisProprietario' => $imoveisProprietario, 'dadosProprietarios'=> $dadosProprietarios] );

    }

    public function finalizarCadastro(Request $request)
    {
        $idProprietario = $request->proprietarioId;

        $taxa = $request->taxa;
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

        $autorizacao = new AutorizacaoLocacao();

        $autorizacao->proprietarioId = $idProprietario;
        $autorizacao->taxa = $taxa;
        $autorizacao->dataInicio = $dataInicio;
        $autorizacao->dataFim = $dataFim;
        $autorizacao->taxa2 = $request->taxa2;
        $autorizacao->taxa3 = $request->taxa3;
        $autorizacao->status = true;
        $autorizacao->texto = null;



        $idAutorizacao = $autorizacao->id;

        $imovelArray = array();
        /*foreach ($request->imovel as $key => $value){
            $imovelAutorizacaoLocacao = new ImovelAutorizacaoLocacao();
            $imovelAutorizacaoLocacao->autorizacaoLocacaoId = $idAutorizacao;
            $imovelAutorizacaoLocacao->status = true;
            $imovelAutorizacaoLocacao->imovelId = $key;
        }*/



        $dadosProprietario = Proprietario::find($idProprietario);



        $dadosAutorizacao = $autorizacao;


        $imoveisAutorizacaoLocacao = $request->imovel;




        return view('autorizacao.locacao.editor', ['dadosAutorizacao' => $dadosAutorizacao, 'dadosProprietario' => $dadosProprietario, 'imoveisAutorizacaoLocacao' => $imoveisAutorizacaoLocacao]);


    }

    public function salvarAutorizacao(Request $request)
    {
        $autorizacao = new AutorizacaoLocacao();
        $autorizacao->proprietarioId = $request->idProprietario;
        $autorizacao->dataInicio = $request->dataInicio;
        $autorizacao->dataFim = $request->dataFim;
        $autorizacao->taxa = $request->taxa;
        $autorizacao->taxa2 = $request->taxa2;
        $autorizacao->taxa3 = $request->taxa3;
        $autorizacao->status = true;
        $autorizacao->texto = $request->texto;

        $autorizacao->save();

        $idAutorizacao = $autorizacao->id;
        foreach ($request->imovel as $key => $value){
            $imovelAutorizacaoLocacao = new ImovelAutorizacaoLocacao();
            $imovelAutorizacaoLocacao->autorizacaoLocacaoId = $idAutorizacao;
            $imovelAutorizacaoLocacao->status = true;
            $imovelAutorizacaoLocacao->imovelId = $key;
            $imovelAutorizacaoLocacao->save();
        }

        return redirect()->route('autorizacao.locacao.show', $idAutorizacao);
    }

    public function downloadFile($id)
    {
        $nomePath = DB::table('anexo_autorizacao_locacao')->select('anexo_autorizacao_locacao.path')->where('anexo_autorizacao_locacao.id', '=', $id)->value('anexo_autorizacao_locacao.path');

        //para fazer download de arquivo$nomePath
        $pathToFile = public_path($nomePath);

        return response()->download($pathToFile);
    }
    public function destroyDocumento($id){
        $documento = AnexoAutorizacaoLocacao::find($id);

        $nomePath = $documento->path;
        $idAutorizacao = $documento->autorizacaoId;

        if (Storage::delete(public_path($nomePath))){
            if ($documento->delete()){
                return redirect()->route('autorizacao.locacao.show', $idAutorizacao)->with(['class-color' => 'alert-success', 'message' => 'Documento Removido com sucesso com sucesso!']);
            }
        }else{
            if ($documento->delete()){
                return redirect()->route('autorizacao.locacao.show', $idAutorizacao)->with(['class-color' => 'alert-success', 'message' => 'Documento Removido com sucesso com sucesso!']);
            }
            return redirect()->route('autorizacao.locacao.show', $idAutorizacao)->with(['class-color' => 'alert-danger', 'message' => 'Erro na remoção de anexo!']);
        }

    }

    public function documentoStore( Request $request)
    {

        $idAutorizacao = $request->idAutorizacao;
        $images=array();

        if($files=$request->file('images')){


            foreach($files as $file){
                $name= str_replace(' ', '_', $request->nome) . '.'.$file->getClientOriginalExtension();
                $file->move('autorizacao/locacao/' . $idAutorizacao ,$name);


                $images[]=$name;

                /*Insert your data*/
                $anexo = new AnexoAutorizacaoLocacao();
                $anexo->path = 'autorizacao/locacao/'. $idAutorizacao . '/'. $name;
                $anexo->nome = $name;
                $anexo->autorizacaoId = $idAutorizacao;
                $anexo->status = true;
                $anexo->save();

            }
        }
        return redirect()->route('autorizacao.locacao.show', $idAutorizacao)->with(['class-color' => 'alert-success', 'message' => 'Documento Anexado com sucesso!']);;


    }

    public function dadosEditor($id){


        return redirect()->route('autorizacao.locacao.editor', $id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dadosAutorizacao = DB::table('autorizacao_locacao')->select('autorizacao_locacao.*', 'autorizacao_locacao.id as idAutorizacao', 'proprietario.*')->join('proprietario', 'proprietario.id', '=', 'autorizacao_locacao.proprietarioId')->where('autorizacao_locacao.id', '=', $id)->get();

        $imoveisAutorizacao = DB::table('imovel_autorizacao_locacao')->select('imovel_autorizacao_locacao.*', 'imovel.id', 'imovel.titulo' , 'imovel.valor_aluguel')->join('autorizacao_locacao', 'autorizacao_locacao.id', '=', 'imovel_autorizacao_locacao.autorizacaoLocacaoId')->join('imovel', 'imovel.id', '=', 'imovel_autorizacao_locacao.imovelId')->where('autorizacao_locacao.id', '=', $id)->get();

        $anexos = DB::table('anexo_autorizacao_locacao')->select('anexo_autorizacao_locacao.*')->where('anexo_autorizacao_locacao.autorizacaoId', '=', $id)->get();

        return view('autorizacao.locacao.show', ['dadosAutorizacao' => $dadosAutorizacao, 'imoveisAutorizacao'=> $imoveisAutorizacao, 'anexos' => $anexos] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $dadosAutorizacao = AutorizacaoLocacao::find($id);
        $texto = $dadosAutorizacao->texto;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<img class="img-responsive" src="images/dudabanner.jpg" style="width: 100%">'. $texto);
        return $pdf->stream('autorizacao.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $idProprietario = $request->proprietarioId;

        $taxa = $request->taxa;
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

        $autorizacao = new AutorizacaoLocacao();

        $autorizacao->proprietarioId = $idProprietario;
        $autorizacao->taxa = $taxa;
        $autorizacao->dataInicio = $dataInicio;
        $autorizacao->dataFim = $dataFim;
        $autorizacao->taxa2 = $request->taxa2;
        $autorizacao->taxa3 = $request->taxa3;
        $autorizacao->status = true;
        $autorizacao->texto = null;
        $autorizacao->idAutorizacao = $request->idAutorizacao;



        return $autorizacao;

        $imovelArray = array();
        /*foreach ($request->imovel as $key => $value){
            $imovelAutorizacaoLocacao = new ImovelAutorizacaoLocacao();
            $imovelAutorizacaoLocacao->autorizacaoLocacaoId = $idAutorizacao;
            $imovelAutorizacaoLocacao->status = true;
            $imovelAutorizacaoLocacao->imovelId = $key;
        }*/



        $dadosProprietario = Proprietario::find($idProprietario);



        $dadosAutorizacao = $autorizacao;


        $imoveisAutorizacaoLocacao = $request->imovel;




        return view('autorizacao.locacao.editor_update', ['dadosAutorizacao' => $dadosAutorizacao, 'dadosProprietario' => $dadosProprietario, 'imoveisAutorizacaoLocacao' => $imoveisAutorizacaoLocacao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dadosAutorizacao = DB::table('autorizacao_locacao')->select('autorizacao_locacao.*', 'autorizacao_locacao.id as idAutorizacao', 'proprietario.*')->join('proprietario', 'proprietario.id', '=','autorizacao_locacao.proprietarioId')->where('autorizacao_locacao.id', '=', $id)->get();


        return view('autorizacao.locacao.edit', ['dadosAutorizacao' => $dadosAutorizacao]);
    }
}

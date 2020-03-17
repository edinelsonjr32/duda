<?php

namespace App\Http\Controllers\Admin;

use App\ImagemImovel;
use App\Imovel;
use App\Proprietario;
use App\TipoImovel;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAluguel()
    {
        $dadosImoveis = DB::table('imovel')
            ->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel','proprietario.nome as nomeProprietario')->join('proprietario', 'proprietario.id', '=', 'imovel.proprietario_id')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel.aluguel', '=', 1)->where('imovel_imagem.principal', '=', 1)->get();




        return view('admin.imovel.aluguel.index', ['dadosImoveis' =>$dadosImoveis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAluguel()
    {
        $proprietarios = Proprietario::all();

        $tipoImovel = TipoImovel::all();

        return view('admin.imovel.aluguel.create', ['proprietarios' => $proprietarios, 'tipoImovel' =>$tipoImovel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAluguel(Request $request)
    {




        $userId = Auth::id();

        $imovel = new Imovel();


        $imovel->user_id =$userId;
        $imovel->tipo_imovel =$request->tipo_imovel;

        $imovel->venda = $request->venda;



        $imovel->aluguel = $request->aluguel;


        if ($request->valor_venda !== null){
            $valorVenda = str_replace('.', '', $request->valor_venda);
            $valorVenda2 = str_replace(',', '.', $valorVenda);

            $imovel->valor_venda = number_format($valorVenda2, 2, ',', '.');;

        }else{
            $imovel->valor_venda = $request->valor_venda;
        }

        if ($request->valor_aluguel !== null){
            $valorAluguel = str_replace('.', '-', $request->valor_aluguel);

            $valorAluguel2 = str_replace(',', 'p', $valorAluguel);

            $valor3 = str_replace('p', '.', $valorAluguel2);
            $valor4 = str_replace('-', '', $valor3);

            $imovel->valor_aluguel = number_format($valor4, 2, ',', '.');
        }else{
            $imovel->valor_aluguel = $request->valor_aluguel;
        }

        $imovel->proprietario_id = $request->proprietario;

        $imovel->mapa = $request->mapa;
        if ($request->impostos !== null){
            $valorImposto = str_replace('.', '', $request->impostos);
            $valorImposto2 = str_replace(',', '.', $valorImposto);
            $imovel->impostos = number_format($valorImposto2, 2, ',', '.');;
        }else{
            $imovel->impostos = $request->impostos;
        }

        if ($request->condominio !== null){
            $valorImposto = str_replace('.', '', $request->condominio);
            $valorImposto2 = str_replace(',', '.', $valorImposto);
            $imovel->condominio = number_format($valorImposto2, 2, ',', '.');;
        }else{
            $imovel->condominio = $request->condominio;
        }


        $imovel->descricao = $request->descricao;
        $imovel->banheiros = $request->banheiros;
        $imovel->suites = $request->suites;
        $imovel->salas = $request->salas;
        $imovel->garagem = $request->garagem;
        $imovel->garagem_coberta = $request->garagem_coberta;
        $imovel->cep = $request->cep;
        $imovel->endereco = $request->endereco;
        $imovel->bairro =$request->bairro;
        $imovel->complemento  =$request->complemento;
        $imovel->cidade  =$request->cidade;
        $imovel->estado  =$request->estado;
        $imovel->ar_condicionado  =$request->ar_condicionado;
        $imovel->bar  =$request->bar;
        $imovel->livraria = $request->livraria;
        $imovel->churrasqueira  =$request->churrasqueira;
        $imovel->cozinha_equipada  =$request->cozinha_equipada;
        $imovel->cozinha_americana  =$request->cozinha_americana;
        $imovel->escritorio  =$request->escritorio;
        $imovel->lavatorio  =$request->lavatorio;
        $imovel->piscina  =$request->piscina;
        $imovel->status  =$request->status;
        $imovel->destaque  =$request->destaque;
        $imovel->numero  =$request->numero;
        $imovel->quartos  =$request->quartos;
        $imovel->despensa  =$request->despensa;
        $imovel->lavatorio  =$request->lavatorio;
        $imovel->edicula  =$request->edicula;
        $imovel->titulo  =$request->titulo;
        $imovel->taxas_extras  = $request->taxas_extras;
        $imovel->contribuicao  =$request->contribuicao;
        $imovel->longitude  =$request->longitude;
        $imovel->latitude  =$request->longitude;
        $imovel->copa = $request->copa;
        $imovel->terraco = $request->terraco;
        $imovel->quarto_empregada = $request->quarto_empregada;
        $imovel->banheiro_empregada = $request->banheiro_empregada;
        $imovel->sala_com_lareira = $request->sala_com_lareira;
        $imovel->banheiro_social = $request->banheiro_social;
        $imovel->placa = $request->placa;
        $imovel->documentado = $request->documentado;
        $imovel->recibo_compra_venda = $request->recibo_compra_venda;
        $imovel->exclusividade = $request->exclusividade;
        $imovel->matricula_celpa = $request->matricula_celpa;
        $imovel->matricula_cosanpa = $request->matricula_cosanpa;
        $imovel->tamanho_frente = $request->tamanho_frente;
        $imovel->tamanho_fundo = $request->tamanho_fundo;
        $imovel->cerca_eletrica = $request->cerca_eletrica;

        $imovel->poco_artesiano = $request->poco_artesiano;
        $imovel->portao_eletronico = $request->portao_eletronico;
        $imovel->concertina = $request->concertina;
        $imovel->elevador = $request->elevador;
        $imovel->escada = $request->escada;
        $imovel->interfone = $request->interfone;
        $imovel->imposto_valor = $request->imposto_valor;

        if($imovel->save()){
            return redirect()->route('admin.imoveis.aluguel.imagem.create', ['imovel'=> $imovel->id]);
        }

    }

    public function imagemCreateAluguel($imovel)
    {
        return view('admin.imovel.aluguel.addImagem', ['imovel_id' => $imovel]);
    }

    public function imagemPrincipalDesativarAluguel($id)
    {
        $dadosImagem = ImagemImovel::find($id);

        $dadosImagem->principal = 0;

        if ($dadosImagem->save()){
            return redirect()->route('admin.imoveis.aluguel.detail', ['id' => $dadosImagem->imovel_id]);
        }
    }

    public function imagemPrincipalAtivarAluguel($id)
    {
        $dadosImagem = ImagemImovel::find($id);
        $idImovel = $dadosImagem->imovel_id;
        $imovel = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $idImovel)->where('imovel_imagem.principal', '=', 1)->get();

        if ($imovel == '[]'){
            $dadosImagem->principal = 1;
            if ($dadosImagem->save()){
                return redirect()->route('admin.imoveis.aluguel.detail', ['id' => $dadosImagem->imovel_id])->with(['class-color' => 'alert-success', 'message' => 'Imagem Principal selecionada com sucesso!']);
            }
        }elseif($imovel !== "[]"){
            return redirect()->route('admin.imoveis.aluguel.detail', ['id' => $dadosImagem->imovel_id])->with(['class-color' => 'alert-danger', 'message' => 'Já existe imagem principal selecionada!']);

        }
    }

    public function destaqueAluguel()
    {

    }
    public function imagemDeleteAluguel($id)
    {
        $imagem = ImagemImovel::find($id);
        $nomeArquivo = $imagem->path;

   if ($imagem == '[]'){
            return redirect()->route('admin.imoveis.aluguel.detail', ['id'=> $imagem->imovel_id])->with(['class-color' => 'alert-danger', 'message' => 'Erro ao remover imagem!']);
        }elseif ($imagem !== '[]'){
            if ($imagem->delete()){
                return redirect()->route('admin.imoveis.aluguel.detail', ['id'=> $imagem->imovel_id])->with(['class-color' => 'alert-success', 'message' => 'Imagem removida com sucesso!']);
            }else{
                return redirect()->route('admin.imoveis.aluguel.detail', ['id'=> $imagem->imovel_id])->with(['class-color' => 'alert-danger', 'message' => 'Erro ao remover imagem!']);
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAluguel($id)
    {

        $imovel = Imovel::find($id);

        $proprietarios = Proprietario::all();

        $tipoImovel = TipoImovel::all();



        if ($imovel !== '[]'){
            return view('admin.imovel.aluguel.edit', ['imovel'=> $imovel, 'proprietarios' => $proprietarios, 'tipoImovel'=> $tipoImovel]);
        }

    }

    public function imagemStoreAluguel( Request $request)
    {

        $images=array();
        $idImovel = $request->imovel_id;
        if($files=$request->file('images')){

            foreach($files as $file){
                $name= $idImovel . '/'.$file->getClientOriginalName();
                $file->move('imovel/images/' . $idImovel ,$name);
                $images[]=$name;
                /*Insert your data*/
                $imagemImovel = new ImagemImovel();

                $imagemImovel->path = $name;
                $imagemImovel->imovel_id = $idImovel;
                $imagemImovel->save();

                $idimagemImovel = $imagemImovel->id;

                $dados = ImagemImovel::where('imovel_id', $idImovel)->first();
                $dados->principal = 1;



                if(!$dados->save()){
                    return redirect()->back()->withInput()->withErrors();
                }

                /*Insert your data*/
            }
        }
        return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-success', 'message' => 'imóvel  cadastrado com sucesso!']);;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na busca de Imóvel, tente novamente!']);
        }else{


            $imagensImoveis = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->get();
            $contador1 = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->count();


            //$imagensImoveisNoActive = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->where('imovel_imagem.principal', '=', 0)->get();

            //return $imagensImoveisNoActive;

            return view(

                'admin.imovel.aluguel.detail',
                [
                    'dadosImovel' => $dadosImovel,
                    'imagensImoveis' => $imagensImoveis,
                    'contador1' => $contador1,
                    'users' => $users

                ]);
        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAluguel(Request $request, $id)
    {
        $dados = Imovel::where('id', $id)->first();




        $dados->fill($request->all());



        $dados->setLivrariaAttribute($request->livraria);
        $dados->setArCondicionadoAttribute($request->ar_condicionado);
        $dados->setBarAttribute($request->bar);
        $dados->setChurrasqueiraAttribute($request->churrasqueira);
        $dados->setCozinhaAmericanaAttribute($request->cozinha_americana);
        $dados->setDespensaAttribute($request->despensa);
        $dados->setCozinhaEquipadaAttribute($request->cozinha_equipada);
        $dados->setEscritorioAttribute($request->escritorio);
        $dados->setLavatorioAttribute($request->lavatorio);
        $dados->setMobiliadoAttribute($request->mobiliado);
        $dados->setCozinhaAttribute($request->cozinha);
        $dados->setCozinhaPlanejadaAttribute($request->cozinha_planejada);
        $dados->setPiscinaAttribute($request->piscina);
        $dados->setEdiculaAttribute($request->edicula);
        $dados->setCopaAttribute($request->copa);
        $dados->setImpostoValorAttribute($request->imposto_valor);
        $dados->setPocoArtesianoAttribute($request->poco_artesiano);
        $dados->setPortaoEletronicoAttribute($request->portao_eletronico);
        $dados->setCercaEletricaAttribute($request->cerca_eletrica);
        $dados->setElevadorAttribute($request->elevador);
        $dados->setInterfoneAttribute($request->interfone);
        $dados->setEscadaAttribute($request->escada);
        $dados->setConcertinaAttribute($request->concertina);
        $dados->setBanheiroEmpregadaAttribute($request->banheiro_empregada);
        $dados->setQuartoEmpregadaAttribute($request->quarto_empregada);
        $dados->setSalaComLareiraAttribute($request->sala_com_lareira);
        $dados->setBanheiroSocialAttribute($request->banheiro_social);
        $dados->setPlacaAttribute($request->placa);
        $dados->setDocumentadoAttribute($request->documentado);
        $dados->setTerracoAttribute($request->terraco);
        $dados->setReciboCompraVendaAttribute($request->recibo_compra_venda);
        $dados->setExclusividadeAttribute($request->exclusividade);

        if(!$dados->save()){
            return redirect()->back()->withInput()->withErrors();
        }elseif ($dados->save()) {


            return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel atualizado com sucesso!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desativarAluguel($id)
    {

        Imovel::where('id', $id)->update(['status'=>0]);



                return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel  Desativado com sucesso!']);

    }


    public function ativarAluguel($id)
    {

        Imovel::where('id', $id)->update(['status'=>1]);



        return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel  Desativado com sucesso!']);

    }
    public function destroyAluguel($id)
    {
        $imovel = Imovel::find($id);



        if ($imovel !== '[]'){
            DB::table('imovel_imagem')->where('imovel_id', '=', $id)->delete();
            DB::table('visitas')->where('imovel_id', '=', $id)->delete();
            if ($imovel->delete()){
                return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel  Removido com sucesso!']);
            }else{
                return redirect()->route('admin.imoveis.aluguel.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na remoção do imóvel!']);
            }
        }

    }



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


        return view('admin.imovel.venda.index', ['dadosImoveis' =>$dadosImoveis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVenda()
    {
        $proprietarios = Proprietario::all();

        $tipoImovel = TipoImovel::all();

        return view('admin.imovel.venda.create', ['proprietarios' => $proprietarios, 'tipoImovel' =>$tipoImovel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVenda(Request $request)
    {




        $userId = Auth::id();

        $imovel = new Imovel();


        $imovel->user_id =$userId;
        $imovel->tipo_imovel =$request->tipo_imovel;

        $imovel->venda = $request->venda;



        $imovel->aluguel = $request->aluguel;


        if ($request->valor_venda !== null){
            $valorVenda = str_replace('.', '', $request->valor_venda);
            $valorVenda2 = str_replace(',', '.', $valorVenda);

            $imovel->valor_venda = number_format($valorVenda2, 2, ',', '.');

        }else{
            $imovel->valor_venda = $request->valor_venda;
        }
        if ($request->area_total !== null){
            $valorVenda = str_replace('.', '', $request->area_total);
            $valorVenda2 = str_replace(',', '.', $valorVenda);

            $imovel->area_total = number_format($valorVenda2, 2, ',', '.');

        }else{
            $imovel->area_total = $request->area_total;
        }


        if ($request->area_util !== null){
            $valorVenda = str_replace('.', '', $request->area_util);
            $valorVenda2 = str_replace(',', '.', $valorVenda);

            $imovel->area_util = number_format($valorVenda2, 2, ',', '.');

        }else{
            $imovel->area_util = $request->area_util;
        }

        if ($request->valor_aluguel !== null){
            $valorAluguel = str_replace('.', '', $request->valor_aluguel);
            $valorAluguel2 = str_replace(',', '.', $valorAluguel);
            $imovel->valor_aluguel = number_format($valorAluguel2, 2, ',', '.');;
        }else{
            $imovel->valor_aluguel = $request->valor_aluguel;
        }

        $imovel->proprietario_id = $request->proprietario;

        if ($request->impostos !== null){
            $valorImposto = str_replace('.', '', $request->impostos);
            $valorImposto2 = str_replace(',', '.', $valorImposto);
            $imovel->impostos = number_format($valorImposto2, 2, ',', '.');;
        }else{
            $imovel->impostos = $request->impostos;
        }

        if ($request->condominio !== null){
            $valorImposto = str_replace('.', '', $request->condominio);
            $valorImposto2 = str_replace(',', '.', $valorImposto);
            $imovel->condominio = number_format($valorImposto2, 2, ',', '.');;
        }else{
            $imovel->condominio = $request->condominio;
        }


        $imovel->descricao = $request->descricao;
        $imovel->banheiros = $request->banheiros;
        $imovel->suites = $request->suites;
        $imovel->salas = $request->salas;
        $imovel->garagem = $request->garagem;
        $imovel->garagem_coberta = $request->garagem_coberta;
        $imovel->area_total = $request->area_total;
        $imovel->area_util = $request->area_util;
        $imovel->cep = $request->cep;
        $imovel->endereco = $request->endereco;
        $imovel->mapa = $request->mapa;
        $imovel->bairro =$request->bairro;
        $imovel->complemento  =$request->complemento;
        $imovel->cidade  =$request->cidade;
        $imovel->estado  =$request->estado;
        $imovel->ar_condicionado  =$request->ar_condicionado;
        $imovel->bar  =$request->bar;
        $imovel->livraria = $request->livraria;
        $imovel->churrasqueira  =$request->churrasqueira;
        $imovel->cozinha_equipada  =$request->cozinha_equipada;
        $imovel->cozinha_americana  =$request->cozinha_americana;
        $imovel->escritorio  =$request->escritorio;
        $imovel->lavatorio  =$request->lavatorio;
        $imovel->piscina  =$request->piscina;
        $imovel->status  =$request->status;
        $imovel->destaque  =$request->destaque;
        $imovel->numero  =$request->numero;
        $imovel->quartos  =$request->quartos;
        $imovel->despensa  =$request->despensa;
        $imovel->lavatorio  =$request->lavatorio;
        $imovel->edicula  =$request->edicula;
        $imovel->titulo  =$request->titulo;
        $imovel->taxas_extras  =$request->taxas_extras;
        $imovel->contribuicao  =$request->contribuicao;
        $imovel->longitude  =$request->longitude;
        $imovel->latitude  =$request->longitude;
        $imovel->copa = $request->copa;
        $imovel->terraco = $request->terraco;
        $imovel->quarto_empregada = $request->quarto_empregada;
        $imovel->banheiro_empregada = $request->banheiro_empregada;
        $imovel->sala_com_lareira = $request->sala_com_lareira;
        $imovel->banheiro_social = $request->banheiro_social;
        $imovel->placa = $request->placa;
        $imovel->documentado = $request->documentado;
        $imovel->recibo_compra_venda = $request->recibo_compra_venda;
        $imovel->exclusividade = $request->exclusividade;
        $imovel->matricula_celpa = $request->matricula_celpa;
        $imovel->matricula_cosanpa = $request->matricula_cosanpa;
        $imovel->tamanho_frente = $request->tamanho_frente;
        $imovel->tamanho_fundo = $request->tamanho_fundo;
        $imovel->cerca_eletrica = $request->cerca_eletrica;

        $imovel->poco_artesiano = $request->poco_artesiano;
        $imovel->portao_eletronico = $request->portao_eletronico;
        $imovel->concertina = $request->concertina;
        $imovel->elevador = $request->elevador;
        $imovel->escada = $request->escada;
        $imovel->interfone = $request->interfone;
        $imovel->imposto_valor = $request->imposto_valor;



        if($imovel->save()){
            return redirect()->route('admin.imoveis.venda.imagem.create', ['imovel'=> $imovel->id]);
        }

    }

    public function imagemCreateVenda($imovel)
    {
        return view('admin.imovel.venda.addImagem', ['imovel_id' => $imovel]);
    }

    public function imagemPrincipalDesativarVenda($id)
    {
        $dadosImagem = ImagemImovel::find($id);

        $dadosImagem->principal = 0;

        if ($dadosImagem->save()){
            return redirect()->route('admin.imoveis.venda.detail', ['id' => $dadosImagem->imovel_id]);
        }
    }

    public function imagemPrincipalAtivarVenda($id)
    {
        $dadosImagem = ImagemImovel::find($id);
        $idImovel = $dadosImagem->imovel_id;
        $imovel = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $idImovel)->where('imovel_imagem.principal', '=', 1)->get();

        if ($imovel == '[]'){
            $dadosImagem->principal = 1;
            if ($dadosImagem->save()){
                return redirect()->route('admin.imoveis.venda.detail', ['id' => $dadosImagem->imovel_id])->with(['class-color' => 'alert-success', 'message' => 'Imagem Principal selecionada com sucesso!']);
            }
        }elseif($imovel !== "[]"){
            return redirect()->route('admin.imoveis.venda.detail', ['id' => $dadosImagem->imovel_id])->with(['class-color' => 'alert-danger', 'message' => 'Já existe imagem principal selecionada!']);

        }
    }

    public function destaqueVenda()
    {

    }
    public function imagemDeleteVenda($id)
    {
        $imagem = ImagemImovel::find($id);

        if ($imagem == '[]'){
            return redirect()->route('admin.imoveis.venda.detail', ['id'=> $imagem->imovel_id])->with(['class-color' => 'alert-danger', 'message' => 'Erro ao remover imagem!']);
        }elseif ($imagem !== '[]'){
            if ($imagem->delete()){
                return redirect()->route('admin.imoveis.venda.detail', ['id'=> $imagem->imovel_id])->with(['class-color' => 'alert-success', 'message' => 'Imagem removida com sucesso!']);
            }else{
                return redirect()->route('admin.imoveis.venda.detail', ['id'=> $imagem->imovel_id])->with(['class-color' => 'alert-danger', 'message' => 'Erro ao remover imagem!']);
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editVenda($id)
    {

        $imovel = Imovel::find($id);

        $proprietarios = Proprietario::all();

        $tipoImovel = TipoImovel::all();



        if ($imovel !== '[]'){
            return view('admin.imovel.venda.edit', ['imovel'=> $imovel, 'proprietarios' => $proprietarios, 'tipoImovel'=> $tipoImovel]);
        }

    }

    public function imagemStoreVenda( Request $request)
    {

        $images=array();
        $idImovel = $request->imovel_id;
        if($files=$request->file('images')){

            foreach($files as $file){
                $name= $idImovel . '/'.$file->getClientOriginalName();
                $file->move('imovel/images/' . $idImovel ,$name);
                $images[]=$name;
                /*Insert your data*/
                $imagemImovel = new ImagemImovel();

                $imagemImovel->path = $name;
                $imagemImovel->imovel_id = $idImovel;
                $imagemImovel->save();

                $idimagemImovel = $imagemImovel->id;

                $dados = ImagemImovel::where('imovel_id', $idImovel)->first();
                $dados->principal = 1;



                if(!$dados->save()){
                    return redirect()->back()->withInput()->withErrors();
                }

                /*Insert your data*/
            }
        }
        return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-success', 'message' => 'imóvel  cadastrado com sucesso!']);;

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
            return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na busca de Imóvel, tente novamente!']);
        }else{


            $imagensImoveis = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->get();
            $contador1 = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->count();


            //$imagensImoveisNoActive = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->where('imovel_imagem.principal', '=', 0)->get();

            //return $imagensImoveisNoActive;

            return view(

                'admin.imovel.venda.detail',
                [
                    'dadosImovel' => $dadosImovel,
                    'imagensImoveis' => $imagensImoveis,
                    'contador1' => $contador1,
                    'users' => $users

                ]);
        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateVenda(Request $request, $id)
    {
        $dados = Imovel::where('id', $id)->first();

        $dados->fill($request->all());



        $dados->setLivrariaAttribute($request->livraria);
        $dados->setArCondicionadoAttribute($request->ar_condicionado);
        $dados->setBarAttribute($request->bar);
        $dados->setChurrasqueiraAttribute($request->churrasqueira);
        $dados->setCozinhaAmericanaAttribute($request->cozinha_americana);
        $dados->setDespensaAttribute($request->despensa);
        $dados->setCozinhaEquipadaAttribute($request->cozinha_equipada);
        $dados->setEscritorioAttribute($request->escritorio);
        $dados->setLavatorioAttribute($request->lavatorio);
        $dados->setMobiliadoAttribute($request->mobiliado);
        $dados->setPiscinaAttribute($request->piscina);
        $dados->setEdiculaAttribute($request->edicula);
        $dados->setCopaAttribute($request->copa);
        $dados->setImpostoValorAttribute($request->imposto_valor);
        $dados->setPocoArtesianoAttribute($request->poco_artesiano);
        $dados->setPortaoEletronicoAttribute($request->portao_eletronico);
        $dados->setCercaEletricaAttribute($request->cerca_eletrica);
        $dados->setElevadorAttribute($request->elevador);
        $dados->setInterfoneAttribute($request->interfone);
        $dados->setEscadaAttribute($request->escada);
        $dados->setConcertinaAttribute($request->concertina);
        $dados->setBanheiroEmpregadaAttribute($request->banheiro_empregada);
        $dados->setQuartoEmpregadaAttribute($request->quarto_empregada);
        $dados->setSalaComLareiraAttribute($request->sala_com_lareira);
        $dados->setBanheiroSocialAttribute($request->banheiro_social);
        $dados->setPlacaAttribute($request->placa);
        $dados->setDocumentadoAttribute($request->documentado);
        $dados->setTerracoAttribute($request->terraco);
        $dados->setReciboCompraVendaAttribute($request->recibo_compra_venda);
        $dados->setExclusividadeAttribute($request->exclusividade);
        $dados->setCozinhaAttribute($request->cozinha);
        $dados->setCozinhaPlanejadaAttribute($request->cozinha_planejada);



        if(!$dados->save()){
            return  'entrou aqui';
            return redirect()->back()->withInput()->withErrors();
        }elseif ($dados->save()) {
            return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel atualizado com sucesso!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desativarVenda($id)
    {

        Imovel::where('id', $id)->update(['status'=>0]);



        return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel  Desativado com sucesso!']);

    }


    public function ativarVenda($id)
    {

        Imovel::where('id', $id)->update(['status'=>1]);



        return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel  Desativado com sucesso!']);

    }
    public function destroyVenda($id)
    {
        $imovel = Imovel::find($id);



        if ($imovel !== '[]'){
            DB::table('imovel_imagem')->where('imovel_id', '=', $id)->delete();

            DB::table('visitas')->where('imovel_id', '=', $id)->delete();
            if ($imovel->delete()){
                return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-success', 'message' => 'Imóvel  Removido com sucesso!']);
            }else{
                return redirect()->route('admin.imoveis.venda.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na remoção do imóvel!']);
            }
        }

    }
}

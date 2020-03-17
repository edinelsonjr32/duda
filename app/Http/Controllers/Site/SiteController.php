<?php

namespace App\Http\Controllers\Site;

use App\Banner;
use App\Corretor;
use App\Imovel;
use App\TipoImovel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        $dadosImoveisVenda = DB::table('imovel')->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel_imagem.principal', '=', 1)->where('imovel.status', '=', 1)->where('imovel.venda', '=', 1)->paginate(9);
        $dadosImoveisAluguel = DB::table('imovel')->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel_imagem.principal', '=', 1)->where('imovel.status', '=', 1)->where('imovel.aluguel', '=', 1)->paginate(9);

        $tipoImoveis = TipoImovel::all();
        $destaques = DB::table('imovel')->select('destaque.id as idDestaque', 'destaque.status as status','imovel.*', 'imovel_imagem.*') ->join('destaque', 'destaque.imovel_id', '=', 'imovel.id')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel_imagem.principal' , '=', 1)->get();


        $imoveisAcessiveis = DB::table('imovel')->select('imovel.*', 'imovel_imagem.*')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel_imagem.principal' , '=', 1)->where('imovel.valor_venda', '<', 600)->orWhere('imovel.valor_aluguel', '<', 600)->get();



        $banner = Banner::all();

        return view('site.index', ['dados' => $dadosImoveisVenda, 'dados2' => $dadosImoveisAluguel, 'destaques' => $destaques, 'banner'=> $banner, 'tipoImoveis' => $tipoImoveis, 'imoveisAcessiveis' => $imoveisAcessiveis]);
    }

    public function corretores(){
        $corretores = Corretor::all();

        return view('site.corretores', compact('corretores', $corretores));
    }
    public function detail($id)
    {

        $tipoImovel = DB::table('imovel')
            ->select('imovel.tipo_imovel')->where('imovel.id', '=', $id)->value('imovel.tipo_imovel');


        $imoveisParecidos = DB::table('imovel')->select('imovel.*', 'imovel_imagem.path')->join('imovel_imagem', 'imovel.id', '=', 'imovel_imagem.imovel_id')->where('imovel_imagem.principal', '=', 1)->where('imovel.tipo_imovel', '=', $tipoImovel)->where('imovel.status', '=', 1)->paginate(4);



        $dadosImovel = DB::table('imovel')
            ->select('imovel.*', 'tipo_imovel.nome as nomeTipo')
            ->join('tipo_imovel', 'tipo_imovel.id', '=' ,'imovel.tipo_imovel')
            ->where('imovel.id', '=', $id)
            ->get();

        if ($dadosImovel == '[]'){
            return redirect()->route('site.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na busca de Imóvel, tente novamente!']);
        }else {

            $imagensImoveis = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->get();
            $contador1 = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->count();

            //$imagensImoveisNoActive = DB::table('imovel_imagem')->select('imovel_imagem.*')->where('imovel_imagem.imovel_id', '=', $id)->where('imovel_imagem.principal', '=', 0)->get();

            $tipoImoveis = TipoImovel::all();
            //return $imagensImoveisNoActive;
            return view('site.property',
                [
                    'tipoImoveis' => $tipoImoveis,
                    'dadosImovel' => $dadosImovel,
                    'imagensImoveis' => $imagensImoveis,
                    'contador1' => $contador1,
                    'imoveisParecidos' => $imoveisParecidos
                ]);
        }
    }
    public function imoveis()
    {
        $dadosImoveis = DB::table('imovel')->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel.status', '=', 1)->where('imovel.aluguel', '=', 1)->where('imovel_imagem.principal', '=', 1)->paginate(12);

        $count = Imovel::where('imovel.status', 1)->where('imovel.aluguel', '=', 1)->count();


        $dadosImoveis2 = DB::table('imovel')->select('imovel.*' , 'imovel_imagem.path as path', 'tipo_imovel.nome as nomeTipoImovel')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')->where('imovel.status', '=', 1)->where('imovel.venda', '=', 1)->where('imovel_imagem.principal', '=', 1)->paginate(12);
        $count2 = Imovel::where('imovel.status', 1)->where('imovel.venda', '=', 1)->count();

        $tipoImoveis = TipoImovel::all();
        return view('site.properties', ['dadosImoveis'=> $dadosImoveis, 'count'=> $count, 'dadosImoveis2'=> $dadosImoveis2, 'count2'=> $count2, 'tipoImoveis' => $tipoImoveis]);
    }

    public function buscar()
    {
        $tipoImoveis = TipoImovel::all();
        if (\request()->tipoBusca == 2){

            if (\request()->tipo_imovel == null){//inicio tipo imovel

                if (\request()->quartos == null)
                {//inicio quarto

                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis,'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis,'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis,'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis,'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
                else{//fim quarto
                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
            }else{//fim tipo imovel
                if (\request()->quartos == null)
                {//inicio quarto

                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
                else{//fim quarto
                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.venda' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }

            }
        }
        elseif (\request()->tipoBusca ==1){//inicio tipo busca aluguel

            if (\request()->tipo_imovel == null){//inicio tipo imovel

                if (\request()->quartos == null)
                {//inicio quarto

                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
                else{//fim quarto
                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
            }else{//fim tipo imovel
                if (\request()->quartos == null)
                {//inicio quarto

                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
                else{//fim quarto
                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.aluguel' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }

            }
        }//fim tipo busca aluguel
        else {//inicio busca todos

            if (\request()->tipo_imovel == null){//inicio tipo imovel

                if (\request()->quartos == null)
                {//inicio quarto

                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)
                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
                else{//fim quarto
                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
            }else{//fim tipo imovel
                if (\request()->quartos == null)
                {//inicio quarto

                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
                else{//fim quarto
                    if (\request()->suites == null){//inicio suite vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                        else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                    else{//se suites não for vazio
                        if (\request()->banheiros == null){
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }else{
                            $dadosImoveis = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->paginate();
                            $count = DB::table('imovel')
                                ->select('imovel.*', 'imovel_imagem.path')
                                ->join('imovel_imagem', 'imovel_imagem.imovel_id', '=', 'imovel.id')
                                ->where('imovel_imagem.principal', '=', 1)
                                ->where('imovel.status' , '=', 1)

                                ->where('imovel.banheiros' , '=', \request()->banheiros)
                                ->where('imovel.quartos', '=', \request()->quartos)
                                ->where('imovel.suites' , '=', \request()->suites)
                                ->where('imovel.tipo_imovel', '=', \request()->tipo_imovel)
                                ->count();
                            return view('site.properties_busca', ['tipoImoveis' => $tipoImoveis, 'dadoImoveis' => $dadosImoveis, 'count'=> $count]);
                        }
                    }
                }
            }
        }
    }
}

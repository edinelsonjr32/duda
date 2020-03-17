<?php

namespace App\Http\Controllers\Admin;

use App\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $emails = DB::table('email')->select('email.*')->orderByRaw('created_at  DESC')->where('email.status', '=', 1)->paginate(15);
        $emailsRecebidos = DB::table('email')->select('email.*')->where('email.status', '=', 1)->count();
        $emailsEnviados = DB::table('email')->select('email.*')->where('email.enviado', '=', 1)->where('email.status', '=', 1)->count();
        $emailsNaoLidosCount = DB::table('email')->select('email.*')->where('email.lido', '=', 0)->where('email.status', '=', 1)->count();
        $emailsExcluidos = DB::table('email')->select('email.*')->where('email.status', '=', 0)->count();
        return view('admin.email.index', ['emails' =>  $emails, 'emailsRecebidos' => $emailsRecebidos, 'emailsNaoLidosCount' => $emailsNaoLidosCount, 'emailsEnviados' => $emailsEnviados, 'emailsExcluidos'=>  $emailsExcluidos]);
    }

    public function naoLidos()
    {
        $emailsNaoLidos = DB::table('email')->select('email.*')->where('email.lido', '=', 0)->where('email.status', '=', 1)->orderByRaw('created_at  DESC')->paginate(15);
        $emailsRecebidos = DB::table('email')->select('email.*')->count();
        $emailsEnviados = DB::table('email')->select('email.*')->where('email.enviado', '=', 1)->where('email.status', '=', 1)->count();
        $emailsNaoLidosCount = DB::table('email')->select('email.*')->where('email.lido', '=', 0)->where('email.status', '=', 1)->count();
        $emailsExcluidos = DB::table('email')->select('email.*')->where('email.status', '=', 0)->count();
        return view('admin.email.index', ['emails' =>  $emailsNaoLidos, 'emailsRecebidos' => $emailsRecebidos, 'emailsNaoLidosCount' => $emailsNaoLidosCount, 'emailsEnviados' => $emailsEnviados, 'emailsExcluidos'=>  $emailsExcluidos]);
    }

    public function excluidos()
    {
        $emailsExcluidos1 = DB::table('email')->select('email.*')->where('email.status', '=', 0)->orderByRaw('created_at  DESC')->paginate(15);
        $emailsRecebidos = DB::table('email')->select('email.*')->count();
        $emailsEnviados = DB::table('email')->select('email.*')->where('email.enviado', '=', 1)->where('email.status', '=', 1)->count();
        $emailsNaoLidosCount = DB::table('email')->select('email.*')->where('email.lido', '=', 0)->where('email.status', '=', 1)->count();
        $emailsExcluidos = DB::table('email')->select('email.*')->where('email.status', '=', 0)->count();
        return view('admin.email.excluidos', ['emails' =>  $emailsExcluidos1, 'emailsRecebidos' => $emailsRecebidos, 'emailsNaoLidosCount' => $emailsNaoLidosCount, 'emailsEnviados' => $emailsEnviados, 'emailsExcluidos'=>  $emailsExcluidos]);
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



        $email = new Email();

        $email->nome = $request->nome;
        $email->email = $request->email;
        $email->titulo = $request->titulo;
        $email->telefone = $request->telefone;
        $email->mensagem = $request->mensagem;
        $email->recebido = 1;
        $email->status = 1;





        if ($email->save()){
            return redirect()->route('site.imovel.detail', $request->idImovel);
        }else{
            return redirect()->route('site.imovel.detail', $request->idImovel);
        }
    }

    public function store2(Request $request)
    {

        $email = new Email();

        $email->nome = $request->nome;
        $email->email = $request->email;
        $email->titulo = $request->titulo;
        $email->telefone = $request->telefone;
        $email->mensagem = $request->mensagem;
        $email->recebido = 1;
        $email->status = 1;



        if ($email->save()){
            return redirect()->route('site.sobre');
        }else{
            return redirect()->route('site.sobre');
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
        $email = Email::find($id);





        if ($email->lido == 0){
            $email->lido = 1;


            if ($email->save()){
                $emailsRecebidos = DB::table('email')->select('email.*')->where('email.status', '=', 1)->count();
                $emailsEnviados = DB::table('email')->select('email.*')->where('email.enviado', '=', 1)->where('email.status', '=', 1)->count();
                $emailsNaoLidosCount = DB::table('email')->select('email.*')->where('email.lido', '=', 0)->where('email.status', '=', 1)->count();
                $emailsExcluidos = DB::table('email')->select('email.*')->where('email.status', '=', 0)->count();
                return view('admin.email.show', ['email' =>  $email, 'emailsRecebidos' => $emailsRecebidos, 'emailsNaoLidosCount' => $emailsNaoLidosCount, 'emailsEnviados' => $emailsEnviados, 'emailsExcluidos'=>  $emailsExcluidos]);
            }else{
                return route('admin.email.index');
            }
        }else{
            $emailsRecebidos = DB::table('email')->select('email.*')->where('email.status', '=', 1)->count();
            $emailsEnviados = DB::table('email')->select('email.*')->where('email.enviado', '=', 1)->where('email.status', '=', 1)->count();
            $emailsNaoLidosCount = DB::table('email')->select('email.*')->where('email.lido', '=', 0)->where('email.status', '=', 1)->count();
            $emailsExcluidos = DB::table('email')->select('email.*')->where('email.status', '=', 0)->count();
            return view('admin.email.show', ['email' =>  $email, 'emailsRecebidos' => $emailsRecebidos, 'emailsNaoLidosCount' => $emailsNaoLidosCount, 'emailsEnviados' => $emailsEnviados, 'emailsExcluidos'=>  $emailsExcluidos]);
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
        $email = Email::find($id);



        if ($email !== '[]'){
            $email->status = 0;

            if ($email->save()){
                return redirect()->route('admin.email.index')->with(['class-color' => 'alert-success', 'message' => 'Email Removido com Sucesso!']);
            }else{
                return redirect()->route('admin.email.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro ao excluir email!']);
            }
        }else{
            return redirect()->route('admin.email.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro ao encontrar email!']);
        }
    }

    public function recuperar($id)
    {
        $email = Email::find($id);

        if ($email !== '[]'){
            $email->status = 1;

            if ($email->save()){
                return redirect()->route('admin.email.index')->with(['class-color' => 'alert-success', 'message' => 'Email Recuperado com Sucesso!']);
            }else{
                return redirect()->route('admin.email.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro ao recuperar email!']);
            }
        }else{
            return redirect()->route('admin.email.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro ao encontrar email!']);
        }
    }
}

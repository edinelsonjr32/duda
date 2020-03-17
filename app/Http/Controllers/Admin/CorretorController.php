<?php

namespace App\Http\Controllers\Admin;

use App\Corretor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CorretorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corretores = Corretor::all();

        return view('admin.corretor.index', compact('corretores' , $corretores));
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
        $corretor = new Corretor();

        $images=array();
        $file = $request->file('path');

        if($files=$request->file('path')){
            foreach($files as $file){
                $name= $file->getClientOriginalName();
                $file->move('imovel/images/corretor',$name);
                $images[]=$name;
                /*Insert your data*/
                $corretor->path = $name;
                $corretor->nome = $request->nome;
                $corretor->codigo = $request->codigo;
                $corretor->telefone = $request->telefone;


                if($corretor->save()){
                    return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-success', 'message' => 'Corretor  cadastrado com sucesso!']);
                }else{
                    return redirect()->back()->withInput()->withErrors();
                }
            }
        }else{
            return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-success', 'message' => 'Corretor  cadastrado com sucesso!']);
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
        $dadosCorretor = Corretor::find($id);

        return view('admin.corretor.edit', ['dadosCorretor' => $dadosCorretor]);
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


        $corretor = Corretor::where('id', $request->idCorretor)->first();


        $images=array();
        $file = $request->file('path');

        if($files=$request->file('path')){
            foreach($files as $file){
                $name= $file->getClientOriginalName();
                $file->move('imovel/images/corretor',$name);
                $images[]=$name;
                /*Insert your data*/
                $corretor->path = $name;
                $corretor->nome = $request->nome;
                $corretor->codigo = $request->codigo;
                $corretor->telefone = $request->telefone;


                if($corretor->save()){
                    return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-success', 'message' => 'Corretor  cadastrado com sucesso!']);
                }else{
                    return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na atualização de dados!']);
                }
            }
        }else{

            $corretor->nome = $request->nome;
            $corretor->codigo = $request->codigo;
            $corretor->telefone = $request->telefone;



            if($corretor->save()){
                return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-success', 'message' => 'Dado corretor atualizado com sucesso!']);
            }else{
                return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na atualização de dados!']);
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corretor = Corretor::find($id);

        if ($corretor !== '[]'){
            if ($corretor->delete()){
                return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-success', 'message' => 'Corretor  Removido com sucesso!']);
            }else{
                return redirect()->route('admin.corretor.index')->with(['class-color' => 'alert-danger', 'message' => 'Erro na remoção do corretor!']);
            }
        }
    }
}

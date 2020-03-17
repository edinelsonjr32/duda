<?php

namespace App\Http\Controllers;

use App\FotoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = DB::table('users')->select('users.*', 'tipo_user.nome as nomeTipo')->join('tipo_user', 'users.tipo_user_id', 'tipo_user.id')->get();


        return view('admin.usuario.index', compact('usuarios'));
    }

    public function fotoStore(Request $request)
    {


        $images=array();
        $idusuario = Auth::id();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name= $idusuario . '/'.$file->getClientOriginalName();
                $file->move('usuario/images/' . $idusuario ,$name);
                $images[]=$name;
                /*Insert your data*/
                $foto = new FotoUser();

                $foto->user_id = $idusuario;
                $foto->path = $name;
                $foto->status = true;
                $dadosFotos = DB::table('user_imagem')->select('user_imagem.*')->where('user_imagem.user_id', '=', $idusuario)->where('user_imagem.status', '=', 1)->delete();

                $foto->save();
            }
        }
        return redirect()->route('perfil')->with(['class-color' => 'alert-success', 'message' => 'Foto alterada com sucesso!']);;

    }

    public function perfil()
    {
        $id = Auth::id();

        $dadosUsuario = DB::table('users')->select('users.*', 'tipo_user.nome as nomeTipo')->join('tipo_user', 'tipo_user.id', '=', 'users.tipo_user_id')->where('users.id', '=', $id)->get();


        $imagemFoto = DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', $id)->where('user_imagem.status', '=', true)->value('user_imagem.path');





        return view('perfil', ['dadosUsuario'=> $dadosUsuario, 'imagemFoto' => $imagemFoto]);
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

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apelido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipoUsers' => ['required']
        ]);

        if(
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'tipo_user_id' => $request->tipoUsers,
                'status' => true,
                'apelido' => $request->apelido,
                'password' => Hash::make($request->password),
            ])
        ){
            return redirect(route('admin.usuario.index'))->with(['class-color' => 'alert-success', 'message' => 'Usuário cadastrado com sucesso!']);
        }else{
            return redirect(route('admin.usuario.index'))->with(['class-color' => 'alert-danger', 'message' => 'Erro no cadastro do usuário!']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePerfil(Request $request)
    {
        $user = User::where('id', $request->idUsuario)->first();



        if ($request->password == []){

        }elseif ($request->password !== []){
            if ($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
            }else{

            }
        }

        $user->name = $request->name;

        if ($request->email == $user->email){

        }else{
            $user->email = $request->email;
        }
        $user->apelido =  $request->apelido;
        $user->creci =  $request->creci;



        if(!$user->save()){
            return redirect()->back()->withInput()->withErrors();
        }
        return redirect()->route('perfil')->with(['class-color' => 'alert-success', 'message' => 'Peril atualizado com sucesso!']);
    }
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();


        if ($request->password == []){

        }elseif ($request->password !== []){
            if ($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
            }else{

            }
        }

        $user->name = $request->name;

        if ($request->email == $user->email){

        }else{
            $user->email = $request->email;
        }
        $user->apelido =  $request->apelido;
        $user->creci =  $request->creci;

        $user->tipo_user_id = $request->tipoUsers;


        if(!$user->save()){
            return redirect()->back()->withInput()->withErrors();
        }
        return redirect()->route('admin.usuario.index')->with(['class-color' => 'alert-success', 'message' => 'Usuário atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.usuario.index')->with(['class-color' => 'alert-success', 'message' => 'Usuário removido com sucesso!']);

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
        $idUser = $id;

        $user = User::where('id', $id)->first();


        return view('admin.usuario.edit', ['user'=> $user]);
    }
}

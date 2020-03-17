<?php

namespace App\Http\Controllers;

use App\Banner;
use App\ImagemImovel;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        return view('admin.site.banner', ['banner' => $banner]);
    }

    public function save (Request $request)
    {

        $banner = new Banner();

        $images=array();
        $file = $request->file('images');

        if($files=$request->file('images')){
            foreach($files as $file){
                $name= $file->getClientOriginalName();
                $file->move('imovel/images/banner',$name);
                $images[]=$name;
                /*Insert your data*/

                $banner->path = $name;
                $banner->titulo = $request->titulo;
                $banner->subtitulo = $request->subtitulo;
                $banner->descricao = $request->descricao;


                if($banner->save()){
                    return redirect()->route('site.banner')->with(['class-color' => 'alert-success', 'message' => 'bannerx  cadastrado com sucesso!']);;
                }else{
                    return redirect()->back()->withInput()->withErrors();
                }
            }
        }else{
            return 'não entou aqui ';
        }
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);

        if ($banner->delete()){
            return redirect()->route('site.banner')->with(['class-color' => 'alert-success', 'message' => 'banner removido com sucesso!']);;
        }else{
            return redirect()->route('site.banner')->with(['class-color' => 'alert-danger', 'message' => 'Erro banner  ao remover o banner !']);;
        }
    }


}

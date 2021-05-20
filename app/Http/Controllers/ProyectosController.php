<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use App\Models\Media;
use App\Models\Novedades;
use Illuminate\Support\Facades\Validator;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('proyecto.crearProyecto',compact('categorias'));
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


        $request->validate([
            'title' => 'required|unique:proyectos|max:17',
            'descC' => 'required',
            'meta' => 'required',
            'description' => 'required',
            'cat' => 'required',
            'iban' => 'required',
            'fechaFin' => 'required',
            'image' => 'required'
        ]);


        $user = Auth::user()->id;
        $pathI=$request->file('image')->store('fotosPro','public');

        Proyecto::create([
            'title'=>$request->title,
            'desCorta'=>$request->descC,
            'meta'=>$request->meta,
            'financiacionActual'=>0,
            'section'=>$request->description,
            'idCategoria'=>$request->cat,
            'iban'=>$request->iban,
            'fechaInicio'=>now()->format('Y-m-d'),
            'fechaFin'=>$request->fechaFin,
            'fotoProyecto'=>$pathI,
            'iduser'=>$user
        ]);
        return redirect()->route('planes', ['title' => $request->title]);
    }

    public function storePlanes(Request $request){

        $request->validate([
            'allVent' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'fEnt' => 'required'
        ]);

        Plan::create([
            'nombre'=>$request->name,
            'descripcion'=>$request->desc,
            'ventajas'=>$request->allVent,
            'precio'=>$request->price,
            'participantes'=>0,
            'fechaEntrega'=>$request->fEnt,
            'idProyecto'=>$request->idPro
        ]);

        return back();
    }


    public function storeMedia(Request $request){

        $request->validate([
            'media' => 'required|mimes:mp4,jpg,png,'
        ]);
        //dd($request->media);
        /*$validator = Validator::make($request->all(),[
            'media' => 'required|mimes:mp4,jpg,png'
        ]);*/

        $pathI=$request->file('media')->store('mediaPro','public');
        $split = explode(".",$pathI);

        if(array_pop($split) == "mp4"){
            $video = 1;
        }else{
            $video = 0;
        }

        Media::create([

            'enlace'=>$pathI,
            'videoImg'=>$video,
            'idProyecto'=>$request->proId

        ]);

        return back();

    }


    public function storeAct(Request $request){

        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        Novedades::create([
            'idProyecto'=>$request->idPro,
            'titulo'=>$request->name,
            'descripcion'=>$request->desc,
            'fechaActualizacion'=>now()->format('Y-m-d')
        ]);

        return back();
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
                    <p style="font-size:25px"><strong></strong></p>
                    <p style="color:#7E6969"><strong></strong></p>     * @param  \Illuminate\Http\Request  $request
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

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;

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

        dd($request->allVent);

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

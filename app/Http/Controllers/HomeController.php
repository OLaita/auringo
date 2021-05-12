<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $categorias = Categoria::all();
        $proyectos = Proyecto::where("financiacionActual", ">" , "meta")->orderByDesc('fechaInicio');
        return view('welcome', compact('categorias','proyectos'));
    }
}

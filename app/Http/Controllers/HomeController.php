<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Plan;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //$proyectos = Proyecto::where("financiacionActual", "<" , "meta")->orderByDesc('fechaInicio');
        $proyectos = Proyecto::all()->sortByDESC('financiacionActual')->sortByDESC('fechaInicio')->take(3);
        $totUsuarios = User::all()->count();
        $totProyectos = Proyecto::all()->count();
        $sumFinanciacion = Proyecto::all()->sum("financiacionActual");
        return view('welcome', compact('categorias','proyectos','totUsuarios','totProyectos','sumFinanciacion'));
    }

    public function planes(){

        //$planes = Plan::where('idProyecto',$id);
        return view('proyecto.planes');
    }

}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\PaymentController;
use App\Models\Plan;
use App\Models\Proyecto;
use App\Models\Media;
use App\Models\Comentarios;
use App\Models\Novedades;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'welcome'])->withoutMiddleware('auth');

Auth::routes();


Route::resources([
    'gooCont'=>GoogleController::class,
    'pro'=>ProyectosController::class,
    'home'=>HomeController::class,
    'com'=>ComentariosController::class
]);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/descubrir', function(){
    $proyectos = Proyecto::where("fechaFin", ">=" , now()->format('Y-m-d'))->get();
    $proyectos = Proyecto::where("fechaFin", ">=" , now()->format('Y-m-d'))->get()->chunk(count($proyectos));
    $descPro = Proyecto::where("fechaFin", ">=" , now()->format('Y-m-d'))->orderByDesc('financiacionActual')->orderByDesc('fechaInicio')->take(3)->get();
    $categorias = Categoria::all();
    return view('descubrir',compact('proyectos','categorias','descPro'));
})->name('descubrir');
Route::get("/categoria/{name}", function($name){
    $categorias = Categoria::all();
    $categoria = Categoria::where('categoria',$name)->first();
    $proyectos = Proyecto::where("fechaFin", ">=" , now()->format('Y-m-d'))->where('idCategoria',$categoria->id)->get();
    return view('categoria',compact('categoria','proyectos','categorias'));
})->name("buscarCategoria");
Route::get('/newProject', [App\Http\Controllers\ProyectosController::class, 'index'])->name('newProyect')->middleware('auth');

Route::get('/search',function(Request $request){
    $proyectos = Proyecto::where("fechaFin", ">=" , now()->format('Y-m-d'))->where('title','like','%'.$request->search.'%')->orWhere('desCorta','like','%'.$request->search.'%')->get();
    $users = User::where('username','like','%'.$request->search.'%')->orWhere('name','like','%'.$request->search.'%')->orWhere('surname','like','%'.$request->search.'%')->get();
    return view('search',compact('proyectos','users'));
})->name('search');


Route::group(['prefix' => 'auth'], function () {
    /*Route::get('/{provider}', LoginController::class.'@redirectToProvider');
    Route::get('/{provider}/callback', LoginController::class.'@handleProviderCallback');*/
    Route::get('/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::put('/google-login', [GoogleController::class, 'googleLogin'])->name('googleLogin');

});

Route::group(['prefix' => 'proyecto'], function () {
    Route::get('/{title}/planes', function ($title) {
        $proyectos = Proyecto::where('title',$title)->get();
        $planes = Plan::where('idProyecto',$proyectos[0]['id'])->get();
        $videoImg = Media::where('idProyecto',$proyectos[0]['id'])->get();
        if(Auth::user()->id == $proyectos[0]['iduser']){
            return view('proyecto.planes',compact('proyectos','planes','videoImg'));
        }
        return redirect()->route('home');

    })->name("planes")->middleware('auth');

    Route::get('/{title}/edit', function($title){
        $pro = Proyecto::where('title',$title)->first();
        if(Auth::user()->id == $pro->iduser){
            return view('proyecto.editarProyecto',compact('pro'));
        }
        return redirect()->route('home');
    })->name('editarProyecto');

    Route::delete('/plan/{id}', function($id){
        $plan = Plan::find($id);
        $plan->delete();
        return back();
    })->name('planDes');

    Route::delete('/imgVid/{id}', function($id){
        $media = Media::find($id);
        $media->delete();
        return back();
    })->name('imgVidDes');

    Route::get('/imgPro/{id}', function($id){
        $proyecto = Proyecto::find($id);
        $proyecto->update([
            'fotoProyecto'=>null
        ]);
        return back();
    })->name('imgDel');

    Route::get('/{title}', function ($title) {
        $proyectos = Proyecto::where('title',$title)->get();
        $planes = Plan::where('idProyecto',$proyectos[0]['id'])->orderBy('precio')->get();
        $videoImg = Media::where('idProyecto',$proyectos[0]['id'])->get();
        $comments = Comentarios::where('idProyecto',$proyectos[0]['id'])->orderBy('created_at','DESC')->get();
        $novedades = Novedades::where('idProyecto',$proyectos[0]['id'])->orderBy('fechaActualizacion','DESC')->get()->chunk(3);
        $totPlanes = Plan::where('idProyecto',$proyectos[0]['id'])->sum('participantes');
        return view('proyecto.show',compact('proyectos','planes','videoImg','comments','novedades','totPlanes'));
    })->name("proyecto");

    Route::get('/masplan/{plan}', [PaymentController::class, 'paymentSuccess'])->name("masplan");

    Route::post('/createPlan', [ProyectosController::class, 'storePlanes'])->name("newPlan");
    Route::post('/newMedia', [ProyectosController::class, 'storeMedia'])->name("newMedia");
    Route::post('/newAct', [ProyectosController::class, 'storeAct'])->name('newAct');

    Route::post('/comment', [ComentariosController::class, 'store'])->name("comment")->middleware('auth');
    //Route::put('/comment/update', [ComentariosController::class, 'update'])->name("comment.update");
});



Route::get('/payment/{code},{id}', function($code, $id){
    $plan = Plan::find($id);
    return view('pasarela2',compact('plan'));
})->name("pagar")->middleware('auth');
Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment')->middleware('auth');





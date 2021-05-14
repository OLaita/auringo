<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyectosController;
use App\Models\Plan;
use App\Models\Proyecto;

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
    'home'=>HomeController::class
]);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/newProject', [App\Http\Controllers\ProyectosController::class, 'index'])->name('newProyect');

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
        $planes = Plan::where('idProyecto',$proyectos[0]['id']);
        if(Auth::user()->id == $proyectos[0]['iduser']){
            return view('proyecto.planes',compact('proyectos','planes'));
        }
        return redirect()->route('home');

    })->name("planes");
    Route::post('/createPlan', [ProyectosController::class, 'storePlanes'])->name("newPlan");
});





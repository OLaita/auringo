<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comentarios;
use App\Models\Proyecto;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /*public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }*/

    public function index(){
        return view('admin.adminPanel');
    }

    public function getUsers(){
        $users = User::all();
        return view('admin.userList',compact('users'));
    }

    public function getProyects(){
        $proyectos = Proyecto::all();
        return view('admin.proList',compact('proyectos'));
    }

    public function resetPassword(Request $request, $id){

        $request->validate([
            'password' => 'required|string|confirmed|min:3'
        ]);

        $user = User::find($id);

        $user->password = Hash::make($request->password);

        Auth::login($user);
        Auth::logoutOtherDevices($request->password);

        $admin = User::find(2);
        Auth::login($admin);
        return redirect()->back();

    }

    public function destroyUser($id)
    {

        $pro = Proyecto::where('iduser',$id)->where('fechaFin',">=",now()->format('Y-m-d'))->first();
        //dd($pro);
        if($pro != null){

            return redirect()->back()->withErrors(['Tiene un proyecto sin vencer']);

        }

        $com = Comentarios::where('idUser',$id);
        $com->delete();

        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

    public function destroyProyect($id){
        $pro = Proyecto::find($id);
        $pro->delete();

        return redirect()->back();
    }

}


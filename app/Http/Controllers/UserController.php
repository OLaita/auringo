<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request,$id){
        $user = User::find($id);

        if($request->hasFile('avatar')){
            $pathI=$request->file('avatar')->store('avateres','public');
            $pathI = "/storage/".$pathI;
        }else{
            $pathI = $user->image;
        }

        $user->update([
            'username'=>$request->username,
            'biografia'=>$request->biografia,
            'image'=>$pathI
        ]);

        return redirect()->route('perfil',['user'=>$request->username]);
    }

    public function destroy($id)
    {

        $pro = Proyecto::where('iduser',$id)->where('fechaFin',">=",now()->format('Y-m-d'))->first();
        //dd($pro);
        if($pro != null){

            return redirect()->back()->withErrors(['Tienes un proyecto sin vencer']);

        }

        $user = User::find($id);
        $user->delete();

        return redirect()->route('welcome');
    }


    public function changePassword(Request $request, $id){

        $request->validate([
            'oldPassword' => 'required|string|min:3',
            'password' => 'required|string|confirmed|min:3'
        ]);

        $user = User::find($id);

        if (Hash::check($request->oldPassword, $user->password))
        {
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
            Auth::logout();
            return redirect()->route('login');

        }else{
            return redirect()->back()->withErrors(['La contraseña no coincide con la actual']);
        }
    }

    /*           PARTE API           */

    public function store(Request $request)
    {
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->country = $request->country;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

    }

    public function show($id)
    {
        return User::where('id', $id)->get();
    }
}

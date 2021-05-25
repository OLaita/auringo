<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function update(Request $request,$id){
        //dd($request->username);
        $user = User::find($id);

        $user->update([
            'username'=>$request->username,
            'biografia'=>$request->biografia
        ]);

        return redirect()->route('editUser',['user'=>$request->username]);
    }
}

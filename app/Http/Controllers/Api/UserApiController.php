<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Comentarios;

class UserApiController extends BaseController
{
    public function register(Request $request)
    {
        $dataValidated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'],
        ]);
        $avatar = Storage::url('usericon.png');
        $user = User::create([
            'name' => $dataValidated['name'],
            'surname' => $dataValidated['surname'],
            'country' => $dataValidated['country'],
            'username' => $dataValidated['username'],
            'email' => $dataValidated['email'],
            'password' => Hash::make($dataValidated['password']),
            'rol_id' => 2,
            'image' => $avatar
        ]);
        $token = $user->createToken('AppNAME')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $success['token'] =  $user->createToken('AppName')->accessToken;
            $success['user'] =  $user->email;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

    public function show($id)
    {
        return User::find($id);
    }



    public function update(Request $request, $id){

        $user = User::find($id);

        foreach($request->all() as $key => $value){
            if($key == 'password'){
                $user->$key = Hash::make($value);
            }else{
                $user->$key = $value;
            }

        }

        $user->save();
        return 'Update OK';

    }


    public function delete($id){

        $com = Comentarios::where('idUser',$id);
        $com->delete();

        $user = User::find($id);

        $user->delete();
        return 'Delete OK';

    }


}

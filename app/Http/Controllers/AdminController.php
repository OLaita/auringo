<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{

    public function index(){
        $users = User::all();
        return view('admin.adminPanel');
    }

    public function getUsers(){
        $users = User::all();
        return view('admin.userList',compact('users'));
    }

}

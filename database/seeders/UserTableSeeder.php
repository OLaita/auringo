<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Storage;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_user = Roles::where('rol', 'user')->first();
        $role_admin = Roles::where('rol', 'admin')->first();
        $avatar = Storage::url('usericon.png');
        //dd($role_admin);

        $user = new User();
        $user->username = 'user1';
        $user->name = 'Pedro';
        $user->surname = 'Picapiedra';
        $user->email = 'user@example.com';
        $user->password = bcrypt('user1');
        $user->country = 'España';
        $user->rol_id = 2;
        $user->image = $avatar;
        $user->timestamps = false;
        $user->save();
        $user->rol()->attach($role_user);


        $user = new User();
        $user->username = 'admin';
        $user->name = 'Administrador';
        $user->surname = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->country = 'España';
        $user->rol_id = 1;
        $user->image = $avatar;
        $user->timestamps = false;
        $user->save();
        $user->rol()->attach($role_admin);

    }
}

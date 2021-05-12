<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new Categoria();
        $cat->categoria = 'Arte';
        $cat->timestamps = false;
        $cat->save();

        $cat = new Categoria();
        $cat->categoria = 'Comics & Ilustración';
        $cat->timestamps = false;
        $cat->save();

        $cat = new Categoria();
        $cat->categoria = 'Diseño & Tecnologia';
        $cat->timestamps = false;
        $cat->save();

        $cat = new Categoria();
        $cat->categoria = 'Cine';
        $cat->timestamps = false;
        $cat->save();

        $cat = new Categoria();
        $cat->categoria = 'Alimentación';
        $cat->timestamps = false;
        $cat->save();

        $cat = new Categoria();
        $cat->categoria = 'Juegos';
        $cat->timestamps = false;
        $cat->save();

        $cat = new Categoria();
        $cat->categoria = 'Musica';
        $cat->timestamps = false;
        $cat->save();

    }
}

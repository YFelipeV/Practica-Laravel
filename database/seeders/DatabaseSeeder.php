<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('roles')->insert([
            "nombre" => 'auto',
            'created_at'=>\now(),
            'updated_at'=>null,
        ]);
      /*  DB::table('roles')->insert([
            "nombre" => 'usuario'
        ]);
        DB::table('roles')->insert([
            "nombre" => 'invitado'
        ]);
        */
    }
}

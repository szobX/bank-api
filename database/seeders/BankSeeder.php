<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(App\Bank::class,4)->create();
        \App\Models\Bank::Factory(5)->create();

    }
}

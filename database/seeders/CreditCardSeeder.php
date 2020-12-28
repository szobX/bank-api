<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\CreditCard::Factory(10)->create();

    }
}

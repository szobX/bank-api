<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddressSeeder::class);
         \App\Models\User::factory(10)->create();
        $this->call([BankSeeder::class,AccountSeeder::class,CreditCardSeeder::class,TranastionSeeder::class]);
          }
}

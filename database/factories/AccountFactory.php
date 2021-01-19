<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bank = \App\Models\Bank::all()->random();
        $bankIdentify = $bank->identify;
        return [
            'account_name'=>$this->faker->numerify('konto ##'),
            'account_number'=>$this->faker->numerify("$bankIdentify-####-####-####-###-#"),
            'user_id'=>\App\Models\User::all()->random()->id,
            'bank_id'=>$bank->id,
            'date_opened'=>$this->faker->dateTime,
            'balance'=>$this->faker->randomFloat(2,0,99999),
        ];
    }
}

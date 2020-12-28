<?php

namespace Database\Factories;

use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'=>$this->faker->creditCardType,
            'number'=>$this->faker->numerify("####-####-####-####"),
            'exp_date'=>$this->faker->creditCardExpirationDateString,
            'cvv'=>$this->faker->numberBetween(100,999),
            'account_id'=>\App\Models\Account::all()->random()->id,
            'active'=>$this->faker->boolean,
            'limit_per_day'=>$this->faker->randomFloat(0,0,10000),

        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class  AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //     $table->string('city');
            //            $table->string('post_code');
            //            $table->string('street_and_number');
            //            $table->string('country');
            'city'=>$this->faker->city,
            'post_code'=>$this->faker->postcode,
            'street_and_number'=>$this->faker->streetAddress,
            'country'=>$this->faker->country,
        ];
    }
}

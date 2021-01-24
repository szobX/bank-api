<?php

namespace Database\Factories;

use App\Models\Transactions;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transactions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = $this->faker->randomFloat(2,-9999,9999);
        $from_account = \App\Models\Account::all()->random();
        $to_account = \App\Models\Account::all()->random();

        $current_balance = floatval($from_account->balance) + $amount;
        return [
            //   $table->boolean('transfer_type');  //  0 - incoming 1 -> outgoing
            //            $table->timestamp('date')->useCurrent();
            //            $table->integer('from_account_id')->unsigned()->index();
            //            $table->decimal('amount',9,2);
            //            $table->decimal('current_balance');
            //            $table->string('title');
            //            $table->dateTime('transfer_date');
            //            $table->integer('to_account_id')->unsigned()->index();
            //            $table->foreign('from_account_id')->references('id')->on('accounts')->onDelete('cascade');
            //            $table->foreign('to_account_id')->references('id')->on('accounts')->onDelete('cascade');
            //            $table->timestamps();
            'transfer_type'=>$this->faker->boolean,
            'date'=>$this->faker->dateTime(),
            'from_account_id'=>$from_account->id,
            'amount'=>$amount,
            'current_balance'=>$current_balance,
            'title'=>$this->faker->catchPhrase,
            'transfer_date'=>$this->faker->dateTime('2021-01-01 16:00:00'),
            'to_account_id'=>$to_account->id
        ];
    }
}

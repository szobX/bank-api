<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->boolean('transfer_type');  //  0 - incoming 1 -> outgoing
            $table->timestamp('date')->useCurrent();
            $table->integer('from_account_id')->unsigned()->index();
            $table->decimal('amount',9,2);
            $table->decimal('current_balance');
            $table->string('title');
            $table->dateTime('transfer_date');
            $table->integer('to_account_id')->unsigned()->index();
            $table->foreign('from_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('to_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

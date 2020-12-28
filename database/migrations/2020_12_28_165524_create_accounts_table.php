<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name');
            $table->string('account_number');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bank_id');
//            $table->unsignedBigInteger('credit_card_id')->nullable();
            $table->dateTime('date_opened')->useCurrent();
            $table->decimal('balance',9,2)->default(0000000.00);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
//            $table->foreign('credit_card_id')->references('id')->on('credit_cards')->onDelete('cascade');

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
        Schema::dropIfExists('accounts');
    }
}

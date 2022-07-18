<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('esewa_number')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('receiver_contact_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('account_number')->nullable();
            $table->string('full_name')->nullable();
            $table->string('receiver_contact_number')->nullable();
            $table->string('pick_up_district')->nullable();
            $table->string('received_date')->nullable();

            $table->float('remit_amount')->nullable();
            $table->double('npr', 15, 2)->nullable();
            $table->string('transfer_receipt')->nullable();
            $table->string('rate')->nullable();
            $table->tinyInteger('promo_code')->default(0)->nullable();
            $table->string('status')->default(0);
            $table->string('random_token')->nullable();
            $table->string('new')->default(0);
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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

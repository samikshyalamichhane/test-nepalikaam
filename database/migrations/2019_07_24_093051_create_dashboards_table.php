<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('image')->nullable();
            $table->text('rate')->nullable();
            $table->string('transaction_limit_bank_deposit')->nullable();
            $table->string('transaction_limit_remit')->nullable();
            $table->string('transaction_limit_esewa')->nullable();
            $table->string('service_charge')->nullable();
            $table->string('discounted_amount')->nullable();
            $table->string('promo_code')->nullable();
            $table->text('mission')->nullable();
            $table->text('map')->nullable();
            $table->text('notice')->nullable();
            $table->text('advertisement')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('dashboards');
    }
}

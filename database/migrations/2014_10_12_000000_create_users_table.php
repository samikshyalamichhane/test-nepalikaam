<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('citizenship')->nullable();
            $table->bigInteger('customerid')->nullable();
            $table->string('idtype')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->nullable();
            $table->string('access_level')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('suberb')->nullable();
            $table->string('state')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country')->nullable();
            $table->string('main')->default(1);
            $table->string('manualy')->default(0);
            $table->string('flag')->comment('1->admin | 0->editor');
            $table->enum('publish',['new','approved','rejected'])->default('new');
            $table->string('verifyToken')->nullable();
            $table->string('new')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

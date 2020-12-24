<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('username')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('other_email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('phone2')->nullable();
            $table->set('gender', ['male', 'female'])->nullable();
            $table->set('religion', ['Islam', 'Christianity'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->default('1.png')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['id']);

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

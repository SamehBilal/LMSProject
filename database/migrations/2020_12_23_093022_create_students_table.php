<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('serial')->unique();
            $table->unsignedBigInteger('stage_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('class_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('document')->nullable();
            $table->set('status', ['hold', 'accepted','graduated']);
            $table->set('blood_type', ['A+', 'A-','B+','B-','AB+','AB-','O+','O-']); 



            $table->timestamps();

            $table->index(['serial', 'created_at']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

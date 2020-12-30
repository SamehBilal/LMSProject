<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('attendance')->default(0);
            $table->date('date');
            $table->unsignedBigInteger('class_id');
            $table->longText('notes');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('class_id')->references('id')->on('class_rooms')->onDelete('cascade');

            $table->index(['id','class_id','date']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}

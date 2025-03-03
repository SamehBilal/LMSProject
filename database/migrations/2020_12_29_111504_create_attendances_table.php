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
            $table->unsignedBigInteger('student_id');
            $table->date('date');
            $table->set('month', ['January','February','March','April','May','June','July',
            'August','September','October','November','December']);
            $table->unsignedBigInteger('class_id');
            $table->boolean('attendance')->default(0);
            $table->longText('notes');


            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); 
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

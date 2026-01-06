<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('doctor_id');
        $table->unsignedBigInteger('patient_id');
        $table->date('date');
        $table->string('time_slot')->nullable(); // allow day-level booking
 // e.g. "19:20"
        $table->string('status')->default('booked');
        $table->timestamps();

        $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

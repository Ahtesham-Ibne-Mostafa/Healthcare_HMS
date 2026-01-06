<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_title');
            $table->decimal('package_price', 10, 2)->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->date('booking_date')->nullable();
            $table->string('time_slot')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

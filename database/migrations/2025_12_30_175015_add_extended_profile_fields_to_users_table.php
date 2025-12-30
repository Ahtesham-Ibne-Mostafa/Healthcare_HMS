<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('phone');   // path to uploaded image
            $table->date('dob')->nullable()->after('profile_picture');       // date of birth
            $table->string('gender')->nullable()->after('dob');              // Male/Female/Other
            $table->string('emergency_contact')->nullable()->after('gender'); // emergency contact name/number
            $table->string('insurance_provider')->nullable()->after('emergency_contact'); // optional insurance info
            $table->string('policy_number')->nullable()->after('insurance_provider');     // optional insurance policy
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_picture',
                'dob',
                'gender',
                'emergency_contact',
                'insurance_provider',
                'policy_number',
            ]);
        });
    }

};

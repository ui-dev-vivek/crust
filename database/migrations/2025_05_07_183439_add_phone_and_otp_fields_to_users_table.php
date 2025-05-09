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
            // Make email nullable
            $table->string('email')->nullable()->change();

            // Add phone and OTP fields
            $table->string('phone', 15)->unique()->nullable()->after('email');
            $table->string('otp')->nullable()->after('phone');
            $table->timestamp('otp_expires_at')->nullable()->after('otp');
            $table->boolean('is_phone_verified')->default(false)->after('otp_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert email to not nullable (optional, only if it was not nullable before)
            $table->string('email')->nullable(false)->change();

            // Drop added fields
            $table->dropColumn(['phone', 'otp', 'otp_expires_at', 'is_phone_verified']);
        });
    }
};

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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('ios_bundle_id')->nullable();
            $table->string('android_bundle_id')->nullable();
            $table->string('name', 60);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->enum('duration', ['daily', 'weekly', 'monthly', '3-month', '6-month', 'yearly', '2-year', '3-year']);
            $table->enum('type', ['trial', 'non_trial']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};

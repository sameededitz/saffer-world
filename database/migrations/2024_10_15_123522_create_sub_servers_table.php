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
        Schema::create('sub_servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->string('name', 255);
            $table->string('ip_address', 90);
            $table->string('ovpn_user', 255);
            $table->string('ovpn_password', 255);
            $table->string('wg_panel_address')->nullable();
            $table->string('wg_panel_password')->nullable();
            $table->text('ovpn_config')->nullable();
            $table->timestamps();

            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_servers');
    }
};

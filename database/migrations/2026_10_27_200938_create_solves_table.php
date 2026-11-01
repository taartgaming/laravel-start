<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solves', function (Blueprint $table) {
            $table->id();
            // Koppelt de solve aan de ingelogde gebruiker
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('scramble');
            $table->integer('time_ms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solves');
    }
};

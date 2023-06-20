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
        Schema::create('squares', function (Blueprint $table) {
            $table->id();
            $table->integer('width');
            $table->integer('length');
            $table->timestamps();
        });

        Schema::create('circles', function (Blueprint $table) {
            $table->id();
            $table->integer('radius');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('squares');
        Schema::dropIfExists('circles');
    }
};

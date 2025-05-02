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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 20);
            $table->unsignedBigInteger('fuzzy_output_id');
            $table->timestamps();
            $table->foreign('fuzzy_output_id')->references('id')->on('fuzzy_outputs')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};

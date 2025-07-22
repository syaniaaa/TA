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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->decimal('hasil', 5, 1)->nullable();
            $table->decimal('hasil_fuzzy', 5, 1);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('fuzzy_output_id')->nullable();
            $table->string('tingkat_kemungkinan', 20)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fuzzy_output_id')->references('id')->on('fuzzy_outputs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};

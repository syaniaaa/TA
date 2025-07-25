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
        Schema::create('fuzzy_inputs', function (Blueprint $table) {
            $table->id();
            $table->enum('himpunan', ['Ringan', 'Berat']);
            $table->float('min');
            $table->float('max');
            $table->enum('unit', ['Hari', 'Kg', 'Cm', 'Skala']);
            $table->enum('arah', ['Naik', 'Turun']);
            $table->unsignedBigInteger('symptom_id');
            $table->foreign('symptom_id')->references('id')->on('symptoms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_inputs');
    }
};

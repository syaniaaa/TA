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
        Schema::create('fuzzy_outputs', function (Blueprint $table) {
            $table->id();
            $table->enum('himpunan', ['Rendah', 'Sedang', 'Tinggi']);
            $table->float('min');
            $table->float('max');
            $table->float('mid')->nullable(); 
            $table->enum('arah', ['Naik', 'Turun', 'Segitiga']);
            $table->unsignedBigInteger('disease_id');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_outputs');
    }
};

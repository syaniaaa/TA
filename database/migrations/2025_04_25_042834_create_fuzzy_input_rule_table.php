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
        Schema::create('fuzzy_input_rule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fuzzy_input_id');
            $table->foreign('fuzzy_input_id')->references('id')->on('fuzzy_inputs')->onDelete('cascade');
            $table->unsignedBigInteger('rule_id');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_input_rule');
    }
};

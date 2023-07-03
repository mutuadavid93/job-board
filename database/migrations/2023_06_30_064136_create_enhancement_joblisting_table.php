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
        Schema::create('enhancement_joblisting', function (Blueprint $table) {
            $table->id();
            $table->foreignId("enhancement_id")->constrained();
            $table->foreignId("joblisting_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enhancement_joblisting');
    }
};

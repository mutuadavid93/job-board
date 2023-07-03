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
        Schema::create('joblistings', function (Blueprint $table) {
            $table->id();
            $table->string("title"); // e.g. Software Engineer
            $table->string("location"); // "Remote", "Remote / USA", "New York City", "Remote GMT-5", etc.
            $table->string("company_name"); // 
            $table->string("company_logo"); // 
            $table->text("description"); // Very Long Section with Titles and Lists
            $table->string("employment_type"); // Full Time, Part Time
            $table->decimal('salary', 10, 2); // Precision: 10, Scale: 2 i.e. 10 digits with two decimal points
            $table->string("experience_level"); // Senior, Entry

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joblistings');
    }
};

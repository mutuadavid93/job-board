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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Add joblisting_id column to associate the application with a specific joblisting.
            // cascade: when a joblisting is deleted, all associated applications will be deleted as well.
            $table->foreignId('joblisting_id')->constrained()->onDelete('cascade');
            $table->string('fullname', 100); // max: 100 characters
            $table->string('email');
            $table->string('phone', 15); // max: 15 digits
            $table->text('portfolio_link')->nullable(); // URL
            $table->string('attached_cv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->text("description");
            $table->foreignId("category_id")->constrained()->onDelete('cascade');
            $table->foreignId("company_id")->constrained("companies", "id")->onDelete('cascade');
            $table->foreignId("location_id")->constrained("locations", "id")->onDelete('cascade');
            $table->string("employment_type");
            $table->decimal('salary', 10, 2); // Precision: 10, Scale: 2 i.e. 10 digits with two decimal points
            $table->timestamp("application_deadline");
            $table->string("experience_level");
            $table->text("skills");
            $table->boolean("remote")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

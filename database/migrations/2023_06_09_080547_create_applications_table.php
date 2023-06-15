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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->constrained("users", "id")->onDelete("cascade");
            $table->foreignId("joblisting_id")->constrained("job_listings")->onDelete("cascade");
            $table->string("cover_letter");
            $table->string("resume");
            $table->string("status");
            $table->integer("rating")->default(3);

            // JSON data-type.

            // TIP: This is how to save it from ApplicationController;
            // $additionalDocuments = [
            //     'certifications' => [
            //         'https://example.com/certification1',
            //         'https://example.com/certification2',
            //     ],
            //     'portfolio' => [
            //         'https://example.com/portfolio1',
            //         'https://example.com/portfolio2',
            //     ],
            // ];

            // // Save the additional documents to the column
            // $application->additional_documents = $additionalDocuments;
            // $application->save();
            $table->json('additional_documents')->nullable();

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

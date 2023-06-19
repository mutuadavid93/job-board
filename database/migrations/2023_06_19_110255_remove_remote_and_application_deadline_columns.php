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
        Schema::table('job_listings', function (Blueprint $table) {
            // TIP: best practice is to always create new migration files not editing existing ones. 
            // Thus switching back to older versions won't be painful.

            // Drop columns created by an initial migration
            $table->dropColumn('remote');
            $table->dropColumn('application_deadline');
            $table->dropColumn('skills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // HINT: A counter-active logic goes here incase of rolling back
            $table->boolean('remote')->default(false);
            $table->timestamp('application_deadline')->nullable();
            $table->text("skills")->nullable();
        });
    }
};

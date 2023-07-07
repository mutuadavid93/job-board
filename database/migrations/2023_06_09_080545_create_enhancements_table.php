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
        Schema::create('enhancements', function (Blueprint $table) {
            $table->id();
            // $table->foreignId("joblisting_id")->constrained()->onDelete("cascade");
            $table->string("type"); // e.g. type of enhancement (e.g., "Logo", "Boost")
            $table->timestamp("expiration_date")->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean("recurring")->nullable();
            $table->string("color")->nullable(); // Some enhancements don't need it.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enhancements');
    }
};

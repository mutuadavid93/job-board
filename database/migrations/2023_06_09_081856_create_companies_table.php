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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->text("description");
            $table->string("website");
            $table->string("email");
            $table->string("phone");
            $table->string("address");
            $table->string("logo");
            $table->string("industry");
            $table->string("size")->default("medium");
            $table->integer("founded_year");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

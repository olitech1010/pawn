<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id'); // Foreign key to categories table
            $table->string('name')->unique();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};

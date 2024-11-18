<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); // Foreign key to users table
            $table->string('title');
            $table->text('description');
            $table->uuid('category_id'); // Foreign key to categories table
            $table->uuid('sub_category_id'); // Foreign key to subcategories table
            $table->enum('condition', ['New', 'Like New', 'Good', 'Fair', 'Poor']);
            $table->decimal('estimated_value', 10, 2);
            $table->decimal('approved_value', 10, 2)->nullable(); // Admin-approved value
            $table->enum('status', ['Pending', 'Active', 'Rejected', 'Rebuying', 'Expired'])->default('Pending');
            $table->timestamp('rebuy_deadline')->nullable();
            $table->json('photos')->nullable(); // Store paths/URLs of uploaded photos
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title');
            $table->text('description');
            $table->uuid('category_id');
            $table->uuid('sub_category_id');
            $table->enum('condition', ['New', 'Like New', 'Good', 'Fair', 'Poor']);
            $table->decimal('estimated_value', 10, 2);
            $table->decimal('approved_value', 10, 2)->nullable();
            $table->enum('status', ['Pending', 'Active', 'Rejected', 'Rebuying', 'Expired'])->default('Pending');
            $table->timestamp('rebuy_deadline')->nullable();
            $table->json('photos')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->after('id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('sub_category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

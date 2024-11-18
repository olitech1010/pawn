<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('marketplace_items', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('item_id')->nullable();
        $table->decimal('price', 10, 2);
        $table->enum('status', ['Available', 'Sold'])->default('Available');
        $table->timestamps();

        $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplace_items');
    }
};

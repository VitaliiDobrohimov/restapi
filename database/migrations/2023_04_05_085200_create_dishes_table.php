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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image');
            $table->string('url')->default(null);
            $table->text('composition');
            $table->unsignedBigInteger('calories');
            $table->unsignedBigInteger('cost');
            $table->foreignId('category_id')->nullable();
            $table->timestamps();

            //IDX
            $table->index('category_id','dishes_categories_idx');
            //FX
            $table->foreign('category_id','dishes_categories_fk')->on('categories')->references('id')->cascadeOnDelete();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};

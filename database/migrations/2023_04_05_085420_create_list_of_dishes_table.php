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
        Schema::create('list_of_dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('count');
            $table->unsignedSmallInteger('orders_id');
            $table->unsignedSmallInteger('dishes_id');
            $table->timestamps();
            //IDX
            $table->index('orders_id','orders_list_of_dishes_idx');
            $table->index('dishes_id','dishes_list_of_dishes_idx');

            //FX
            $table->foreign('orders_id','orders_list_of_dishes_fk')->on('orders')->references('id')->cascadeOnDelete();;
            $table->foreign('dishes_id','dishes_list_of_dishes_fk')->on('dishes')->references('id')->cascadeOnDelete();;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_of_dishes');
    }
};

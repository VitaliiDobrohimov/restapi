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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number')->unique();
            $table->unsignedSmallInteger('count');
          //  $table->unsignedSmallInteger('dishes_id');
            $table->unsignedSmallInteger('total_cost');
            $table->dateTime('date_closed');
            $table->unsignedSmallInteger('waiter_id');
            //$table->unsignedSmallInteger('list_of_dishes_id');

            $table->timestamps();
            //IDX
            $table->index('waiter_id','orders_users_idx');
         //   $table->index('dishes_id','orders_list_of_dishes_idx');


            //FX
            $table->foreign('waiter_id','orders_users_fk')->on('users')->references('id')->cascadeOnDelete();;
          //  $table->foreign('dishes_id','orders_list_of_dishes_fk')->on('list_of_dishes')->references('id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

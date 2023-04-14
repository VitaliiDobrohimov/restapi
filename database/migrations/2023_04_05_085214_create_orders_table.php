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
            $table->unsignedBigInteger('number')->unique();
            $table->unsignedBigInteger('count')->default(0);
            $table->unsignedBigInteger('total_cost')->default(0);
            $table->dateTime('date_closed')->nullable();
            $table->unsignedSmallInteger('waiter_id');
            $table->boolean('is_closed')->default('false');
            $table->timestamps();
            //IDX
            $table->index('waiter_id','orders_users_idx');
            //FX
            $table->foreign('waiter_id','orders_users_fk')->on('users')->references('id')->cascadeOnDelete();;


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

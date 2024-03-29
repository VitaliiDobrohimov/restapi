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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedSmallInteger('pin_code')->unique();
            $table->foreignId('role_id')->nullable();
            $table->timestamps();
            $table->rememberToken();

            $table->index('role_id','users_role_idx');

            //FX
            $table->foreign('role_id','users_role_fk')->on('roles')->references('id')->cascadeOnDelete();
           // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

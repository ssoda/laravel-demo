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
        Schema::create('orders_jpy', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('price');
        });

        Schema::create('orders_myr', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('price');
        });

        Schema::create('orders_rmb', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('price');
        });

        Schema::create('orders_twd', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('price');
        });

        Schema::create('orders_usd', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('price');
        });

        Schema::create('orders_uid', function (Blueprint $table) {
            $table->string('id')->unique();;
            $table->string('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_jpy');
        Schema::dropIfExists('orders_myr');
        Schema::dropIfExists('orders_rmb');
        Schema::dropIfExists('orders_twd');
        Schema::dropIfExists('orders_usd');
        Schema::dropIfExists('orders_uid');
    }
};

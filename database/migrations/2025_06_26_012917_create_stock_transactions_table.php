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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_variant_id')->unsigned();
            $table->enum('transaction_type', ['addition', 'subtraction', 'adjustment']);
            $table->integer('quantity')->unsigned();
            $table->string('reason', 255)->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->dateTime('transaction_date')->useCurrent();
            $table->timestamps();

            /** Definición de claves foraneas */
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};

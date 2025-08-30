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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('maker_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            /**Definición de claves foraneas */
            $table->foreign('maker_id')->references('id')
                    ->on('makers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                    ->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

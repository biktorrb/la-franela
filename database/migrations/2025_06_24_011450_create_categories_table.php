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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('parent_category_id')->nullable()->unsigned();
            $table->timestamps();

            /** Definición de claves foraneas; Auto-relación para manejo de subcategorias. */
            $table->foreign('parent_category_id')->references('id')
                  ->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('adress_line');
            $table->string('state');
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            /**Definición de claves foraneas */
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

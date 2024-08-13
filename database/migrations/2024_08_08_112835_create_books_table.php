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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('cover')->nullable();
            $table->float('rate')->nullable();
            $table->string('identifier')->unique()->nullable();
            $table->integer('no_rates')->default(0);
            $table->string('pdf')->nullable();
            $table->string('audio')->nullable();
            $table->string('webReaderLink')->nullable();
            $table->json('authors')->nullable();
            $table->json('categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

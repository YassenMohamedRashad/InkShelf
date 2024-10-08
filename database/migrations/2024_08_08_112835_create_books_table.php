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
            $table->string('google_id')->nullable();
            $table->text('cover')->nullable();
            $table->float('rate')->nullable();
            $table->string('identifier')->unique()->nullable();
            $table->integer('no_rates')->default(0);
            $table->text('pdf')->nullable();
            $table->text('audio')->nullable();
            $table->string('webReaderLink')->nullable();
            $table->decimal('price');
            $table->integer('stock');
            $table->string('publishedDate')->nullable();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();

            $table->string('name', 200);
            $table->string('slug', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('address', 255)->nullable();

            $table->decimal('price', 12, 2)->default(0);
            $table->string('price_note', 100)->nullable();

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->string('opening_hours', 100)->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};

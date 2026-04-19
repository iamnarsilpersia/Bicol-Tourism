<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tourist_spots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('location');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('category'); // beach, mountain, historical, etc.
            $table->decimal('entry_fee', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->text('media')->nullable(); // JSON for images/videos
            $table->string('contact_number')->nullable();
            $table->text('basic_info')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tourist_spots');
    }
};

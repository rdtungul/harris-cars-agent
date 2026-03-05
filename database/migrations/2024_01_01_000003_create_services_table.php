<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('service_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('icon')->nullable()->comment('FontAwesome class or custom icon identifier');
            $table->string('image')->nullable();
            $table->string('price_range')->nullable()->comment('e.g. "$29.99 - $59.99" or "Starting at $29.99"');
            $table->string('duration')->nullable()->comment('Estimated service time, e.g. "30-60 minutes"');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('order')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'is_featured']);
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

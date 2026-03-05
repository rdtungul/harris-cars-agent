<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('category')->default('general')->comment('general, before-after, facility, team');
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};

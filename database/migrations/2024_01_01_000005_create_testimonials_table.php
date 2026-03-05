<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_location')->nullable();
            $table->string('customer_vehicle')->nullable()->comment('e.g. "2018 Honda Accord"');
            $table->tinyInteger('rating')->default(5)->comment('1-5 star rating');
            $table->text('review');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('source')->default('website')->comment('website, google, yelp, surecritic, facebook');
            $table->string('source_url')->nullable();
            $table->timestamps();

            $table->index(['is_approved', 'is_featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

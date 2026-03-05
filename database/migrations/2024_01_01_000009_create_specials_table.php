<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('discount_text')->nullable()->comment('e.g. "$10 OFF", "20% OFF", "FREE"');
            $table->string('original_price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('image')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('coupon_code')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'valid_until']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specials');
    }
};

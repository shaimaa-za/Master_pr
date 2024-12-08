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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المستخدم الذي قدم المراجعة
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // المنتج الذي تمت مراجعته
            $table->integer('rating')->unsigned(); // التقييم (من 1 إلى 5)
            $table->text('review')->nullable(); // نص المراجعة
            $table->enum('status', ['pending', 'approved'])->default('pending'); // حالة المراجعة
            $table->timestamps();
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

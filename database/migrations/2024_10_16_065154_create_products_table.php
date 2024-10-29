<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cate_id')->constrained('categories'); // Assuming you have a categories table
            $table->string('product_name');
            $table->string('small_description');
            $table->text('description');
            $table->decimal('original_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->string('image')->nullable(); // Optional if image is not required
            $table->integer('qty')->default(0);
            $table->decimal('tax', 5, 2)->default(0);
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->boolean('trending')->default(0); // 1 = Trending, 0 = Not Trending
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // home_crousals
        Schema::create('home_crousals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('btn_lable')->nullable();
            $table->string('btn_url')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        // home_popups
        Schema::create('home_popups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->string('btn_lable')->nullable();
            $table->string('btn_url')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        // product_types
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        // categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('icon')->nullable();
            $table->string('slug');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // product_groups
        Schema::create('product_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        // products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignId('product_type_id')->constrained('product_types')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('product_group_id')->constrained('product_groups')->cascadeOnDelete();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // product_badges
        Schema::create('product_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_new')->default(0);
            $table->boolean('in_sale')->default(0);
            $table->string('custom')->nullable();
            $table->timestamps();
        });

        // product_images
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('image_url');
            $table->boolean('is_primary')->default(0);
            $table->timestamps();
        });

        // product_seo
        Schema::create('product_seo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();
            $table->timestamps();
        });

        // offer_banners
        Schema::create('offer_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_url');
            $table->string('link_url')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('product_group')->nullable()->constrained('product_groups')->nullOnDelete();
            $table->string('placement');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_banners');
        Schema::dropIfExists('product_seo');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_badges');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_groups');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('product_types');
        Schema::dropIfExists('home_popups');
        Schema::dropIfExists('home_crousals');
    }
};

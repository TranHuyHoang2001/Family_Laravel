<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name', 255)->comment('Tên sản phẩm');
            $table->string('description', 255)->nullable()->comment('Mô tả');
            $table->decimal('price', 10, 0)->default(0)->comment('Giá');
            $table->string('image', 255)->nullable()->comment('Ảnh');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Tạo bởi');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('Cập nhật bởi');
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
}

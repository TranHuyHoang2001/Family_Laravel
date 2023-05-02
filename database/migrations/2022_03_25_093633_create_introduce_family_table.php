<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroduceFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('introduce_family', function (Blueprint $table) {
            $table->id();
            $table->string('description', 255)->nullable()->comment('Mô tả');
            $table->string('image', 255)->nullable()->comment('Hình ảnh');
            $table->text('detail')->nullable()->comment('Chi tiết');
            $table->unsignedBigInteger('family_id')->nullable()->comment('ID gia đình');
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
        Schema::dropIfExists('introduce_family');
    }
}

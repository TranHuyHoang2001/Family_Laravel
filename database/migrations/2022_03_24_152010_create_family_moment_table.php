<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMomentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_moment', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('family_id');
            $table->timestamps();
        });

        Schema::create('family_moment_image', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('family_moment_id');
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
        Schema::dropIfExists('family_moment');
        Schema::dropIfExists('family_moment_image');
    }
}

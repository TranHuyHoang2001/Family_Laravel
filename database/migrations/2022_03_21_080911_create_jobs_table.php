<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Job;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name', '255')->comment('Tên công việc');
            $table->float('point','11', '0')->nullable()->comment('Điểm');
            $table->tinyInteger('highlights')->default(Job::NOTHIGHLIGHTS)->comment('Nổi bật');
            $table->string('image', '255')->nullable()->comment('Hình ảnh');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Tạo bởi');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('Cập nhật bởi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}

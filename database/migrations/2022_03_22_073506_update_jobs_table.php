<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Job;

class UpdateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['highlights', 'image']);
            $table->unsignedBigInteger('role_id')->after('point')->nullable()->comment('Quyền');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->tinyInteger('highlights')->after('point')->default(Job::NOTHIGHLIGHTS)->comment('Nổi bật');
            $table->string('image', '255')->after('highlights')->nullable()->comment('Hình ảnh');
            $table->dropColumn('role_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_family', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('status')->comment('Người làm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_family', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}

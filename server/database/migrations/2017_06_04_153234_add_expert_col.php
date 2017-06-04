<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpertCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors',function (Blueprint $table){
           $table->boolean('isExpert');
           $table->integer('patientNum');
           $table->string('pfTitle');
        });
        DB::table('doctors')->insert(
           [
               'dName' => '张三',
               'beginTime' => time(),
               'endTime' => time() + 100,
               'dpId' => 1,
               'dpName' => '口腔科',
               'isExpert' => true,
               'patientNum' => 15,
               'pfTitle' => '主治医师'
           ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

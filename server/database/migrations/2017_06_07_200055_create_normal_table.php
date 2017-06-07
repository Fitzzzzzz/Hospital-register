<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNormalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normal', function (Blueprint $table) {
            //
            $table->increments('nid');
            $table->integer('dpId');
            $table->string('dpName');
            $table->bigInteger('mcNumber');
            $table->bigInteger('phoneNumber');
        });
        DB::table('normal')->insert(
            [
                'nid' => 1,
                'dpId' => 1,
                'dpName' => '口腔科',
                'mcNumber' => 29475839274,
                'phoneNumber' => 48940394031
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
        Schema::table('normal', function (Blueprint $table) {
            //
        });
    }
}

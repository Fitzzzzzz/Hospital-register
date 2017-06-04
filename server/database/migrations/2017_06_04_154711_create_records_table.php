<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->unsignedBigInteger('pMcNumber');
            $table->unsignedBigInteger('pPhoneNumber');
            $table->integer('dId');
            $table->integer('dpId');
            $table->unsignedBigInteger('beginTime');
            $table->unsignedBigInteger('endTime');
        });
        $patient = DB::table('patients')->where('pid',1)->get();
        $doctor = DB::table('doctors')->where('did',3)->get();
        DB::table('records')->insert(
            [
                'id' => 1,
                'pMcNumber' => $patient[0]->mcNumber,
                'pPhoneNumber' => $patient[0]->phoneNumber,
                'dId' => $doctor[0]->did,
                'dpId' => $doctor[0]->dpId,
                'beginTime' => $doctor[0]->beginTime,
                'endTime' => $doctor[0]->endTime
            ]
        );
        DB::table('doctors')->where('did',3)->decrement('patientNum');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            //
        });
    }
}

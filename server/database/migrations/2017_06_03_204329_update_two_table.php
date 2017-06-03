<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::rename('doctor','doctors');
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('nid','did');
        });
        Schema::table('patients', function (Blueprint $table) {
           $table->renameColumn('id','pid');
        });
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

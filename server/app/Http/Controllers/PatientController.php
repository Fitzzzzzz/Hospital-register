<?php
/**
 * Created by PhpStorm.
 * User: fitzz
 * Date: 17-6-3
 * Time: 下午8:28
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PatientController extends Controller{
    public function init(){
        $info = DB::table('patients')->insert([
           'pid' => 1, 'phoneNumber' => 13644813579, 'mcNumber' => 5596216795
        ]);
        return $info;
    }
}
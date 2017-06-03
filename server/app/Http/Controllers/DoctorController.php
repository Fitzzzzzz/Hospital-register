<?php
/**
 * Created by PhpStorm.
 * User: fitzz
 * Date: 17-6-3
 * Time: 下午8:10
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DoctorController extends Controller{
    public function getAllDoctor(){
        $doctors = DB::table('doctor')->get();
        return $doctors;
    }
    public function getDoctorById($did){
        $doctor = DB::table('doctor')->where('nid',$did)->get();
        return $doctor;
    }
}
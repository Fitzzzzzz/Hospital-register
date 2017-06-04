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
    public function getAllDoctors(){
        $doctors = DB::table('doctors')->get();
        return $doctors;
    }
    public function getDoctorById($did){
        $doctor = DB::table('doctors')->where('did',$did)->get();
        return $doctor;
    }

}
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
        foreach ($doctors as $doctor){
            $doctor->beginTime = date('Y-m-d H:i',$doctor->beginTime);
            $doctor->endTime = date('Y-m-d H:i',$doctor->endTime);
        }
        return $doctors;
    }
    public function getDoctorById($did){
        $doctors = DB::table('doctors')->where('did',$did)->get();
        foreach ($doctors as $doctor){
            $doctor->beginTime = date('Y-m-d H:i',$doctor->beginTime);
            $doctor->endTime = date('Y-m-d H:i',$doctor->endTime);
        }
        return $doctors;
    }
    public function getDoctorByDpId($dpid){
        $doctors = DB::table('doctors')->where('dpId',$dpid)->get();
        foreach ($doctors as $doctor){
            $doctor->beginTime = date('Y-m-d H:i',$doctor->beginTime);
            $doctor->endTime = date('Y-m-d H:i',$doctor->endTime);
        }
        return $doctors;
    }
}
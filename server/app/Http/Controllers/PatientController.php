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
    public function getAllPatients(){
        $patients = DB::table('patients')->get();
        return $patients;
    }
    public function getPatientById($pid){
        $patient = DB::table('patients')->where('pid',$pid)->get();
        return $patient;
    }
    public function getPatientPhoneNumById($pid){
        $patient = $this->getPatientById($pid);
        return $patient[0]->phoneNumber;
    }
    public function getPatientMcNumById($pid){
        $patient = $this->getPatientById($pid);
        return $patient[0]->mcNumber;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: fitzz
 * Date: 17-6-6
 * Time: 下午7:57
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mcController extends Controller {
    public function inputByDoctorId (Request $request) {
        $dpId = $request->input('dpId');
        $phoneNum = $request->input('phoneNum');
        $mcNum = $request->input('mcNum');
        $dId = $request->input('dId');
        $beginTime = strtotime($request->input('beginTime'));
        $endTime = strtotime($request->input('endTime'));
        DB::table('records')->insert(
            [
                'pMcNumber' => $mcNum,
                'pPhoneNumber' => $phoneNum,
                'dId' => $dId,
                'dpId' => $dpId,
                'beginTime' => $beginTime,
                'endTime' => $endTime
            ]
        );
        DB::table('doctors')->where('did','=',$dId)->decrement('patientNum');
    }
    public function getAllRecords () {
        $records = DB::table('records')->get();
        foreach ($records as $record){
            $doctor = DB::table('doctors')->where('did',$record->dId)->get();
//            $record->dId = $doctor->dName;
//            $record->dpId = $doctor->dpName;
        }
        return $records;
    }
}
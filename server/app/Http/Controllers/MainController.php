<?php
/**
 * Created by PhpStorm.
 * User: fitzz
 * Date: 17-6-1
 * Time: 下午8:39
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class MainController extends Controller {
    public function init(){
//        $info1 = DB::table('doctor')->insertGetId(
//          ['dName' => '王医生', 'beginTime' => 1495263600, 'endTime' => 1495264600, 'dpId' => 1, 'dpName' => '口腔科']
//        );
        $info1 = DB::table('doctor')->get();
        $info = $info1[0]->beginTime;
        return dd(date('Y-m-d H:i:s',$info));
    }
}
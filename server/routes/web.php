<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
$app->get('/insert','MainController@init');
$app->get('/doctor/get/all','DoctorController@getAllDoctors');
$app->get('/doctor/get/{did}','DoctorController@getDoctorById');
//$app->post('/doctor/post/id','DoctorController@getDoctorById');

$app->get('/patient/init','PatientController@init');
$app->get('/patient/get/all','PatientController@getAllPatients');
$app->get('/patient/get/{pid}','PatientController@getPatientById');
$app->get('/patient/get/phone/{pid}','PatientController@getPatientPhoneNumById');
$app->get('/patient/get/mc/{pid}','PatientController@getPatientMcNumById');
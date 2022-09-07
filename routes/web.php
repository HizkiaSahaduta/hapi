<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'password' => false,
    'verify' => false,
  ]);

Route::get('ChangeDefaultPassword', 'ChangeDefaultPasswordController@index');
Route::post('ChangeDefPass', 'ChangeDefaultPasswordController@ChangeDefPass');


/*---------------------------------------------------------------------------------------------------------------------------------------------*/
// Route::get('/', 'HomeController@index')->name('/');
Route::get('home', 'HomeController@index')->name('home');
// Route::post('getDashboardItems', 'HomeController@getDashboardItems');
// Route::get('getDashboardOrderLastYear', 'HomeController@getDashboardOrderLastYear');
// Route::get('getDashboardOrderThisYear', 'HomeController@getDashboardOrderThisYear');
// Route::get('getDashboardOrderPrcentageLastYear', 'HomeController@getDashboardOrderPrcentageLastYear');
// Route::get('getDashboardOrderPrcentageThisYear', 'HomeController@getDashboardOrderPrcentageThisYear');
// Route::get('getDashboardOrderPrcentageThisMonth', 'HomeController@getDashboardOrderPrcentageThisMonth');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/

//-- Member Area
Route::get('MemberMgt', 'MemberMgtController@index')->name('MemberMgt');
Route::post('saveDataMember', 'MemberMgtController@saveDataMember')->name('saveDataMember');
Route::post('saveMemberCert', 'MemberMgtController@saveMemberCert')->name('saveMemberCert');
Route::post('saveEditMemberCert', 'MemberMgtController@saveEditMemberCert')->name('saveEditMemberCert');
Route::post('editCert', 'MemberMgtController@editCert')->name('editCert');
Route::post('deleteCert', 'MemberMgtController@deleteCert')->name('deleteCert');
Route::post('listMember', 'MemberMgtController@listMember')->name('listMember');
Route::post('listCert', 'MemberMgtController@listCert')->name('listCert');
Route::post('saveKTP', 'MemberMgtController@saveKTP')->name('saveKTP');
Route::post('saveIjazah', 'MemberMgtController@saveIjazah')->name('saveIjazah');
Route::post('deleteKTP', 'MemberMgtController@deleteKTP')->name('deleteKTP');
Route::post('deleteIjazah', 'MemberMgtController@deleteIjazah')->name('deleteIjazah');
Route::post('getDetailMember', 'MemberMgtController@getDetailMember')->name('getDetailMember');
Route::post('setActive', 'MemberMgtController@setActive')->name('setActive');


Route::get('MemberTrainee', 'MemberTraineeController@index')->name('MemberTrainee');
Route::post('MemberCert', 'MemberCertController@index')->name('MemberCert');

Route::get('member_to_excel','MemberMgtController@member_to_excel');

//-- User Mgmt
Route::get('MyAccount', 'MyAccountController@index')->name('MyAccount');
Route::get('ChangePass', 'ChangePassController@index')->name('ChangePass');
Route::post('ActChangePass', 'ChangePassController@ActChangePass')->name('ActChangePass');
Route::get('AddUser', 'AddUserController@index')->name('AddUser');
Route::post('listUser', 'AddUserController@listUser')->name('listUser');
Route::post('saveUser', 'AddUserController@saveUser')->name('saveUser');
Route::get('getUser/id={id}&id2={id2}', 'AddUserController@getUser');
Route::get('delUser/id={id}&id2={id2}', 'AddUserController@delUser');
Route::post('editUser', 'AddUserController@editUser')->name('editUser');


//-- Master Training
Route::get('MasterTraining', 'MstTrainingController@index')->name('MasterTraining');
Route::post('listTraining', 'MstTrainingController@listTraining')->name('listTraining');
Route::post('saveTraining', 'MstTrainingController@saveTraining')->name('saveTraining');
Route::post('editTraining', 'MstTrainingController@editTraining')->name('editTraining');

//-- JSON Member
Route::get('listIndustrial', 'JSONController@listIndustrial');
Route::get('getMemberID', 'JSONController@getMemberID');
Route::get('getTrainingID', 'JSONController@getTrainingID');
Route::get('listqProvKTP', 'JSONController@listqProvKTP');
Route::get('listqProvDom', 'JSONController@listqProvDom');
Route::get('listqKotaKTP', 'JSONController@listqKotaKTP');
Route::get('listqKotaDom', 'JSONController@listqKotaDom');
Route::get('listqTrainee', 'JSONController@listqTrainee');
Route::get('listMasterPekerjaan', 'JSONController@listMasterPekerjaan');
Route::get('listMasterProvinsi', 'JSONController@listMasterProvinsi');
Route::get('listMasterKota', 'JSONController@listMasterKota');

//-- JSON Trainee
Route::get('getEventID', 'JSONController@getEventID');
Route::get('listOffice', 'JSONController@listOffice');
Route::get('listTraining', 'JSONController@listTraining');
Route::get('listTrainingType/id={id}', 'JSONController@listTrainingType');

//-- Trainee
Route::post('listTrainee', 'MemberTraineeController@listTrainee')->name('listTrainee');
Route::post('listEventDtl', 'MemberTraineeController@listEventDtl')->name('listEventDtl');
Route::post('listMemberClosing', 'MemberTraineeController@listMemberClosing')->name('listMemberClosing');
Route::post('saveEventHdr', 'MemberTraineeController@saveEventHdr')->name('saveEventHdr');
Route::post('saveEventDtl', 'MemberTraineeController@saveEventDtl')->name('saveEventDtl');
Route::post('saveEventClosing', 'MemberTraineeController@saveEventClosing')->name('saveEventClosing');
Route::get('checkEventHdr/id={id}', 'MemberTraineeController@checkEventHdr');
Route::post('getEventHdr', 'MemberTraineeController@getEventHdr');
Route::post('getExpiredDate', 'MemberTraineeController@getExpiredDate');
Route::post('getQtyEventMember', 'MemberTraineeController@getQtyEventMember');
Route::post('getAvailMember', 'MemberTraineeController@getAvailMember')->name('getAvailMember');
Route::post('deleteMemberEvent', 'MemberTraineeController@deleteMemberEvent')->name('deleteMemberEvent');
Route::post('checkTypeTraining', 'MemberTraineeController@checkTypeTraining')->name('checkTypeTraining');


//-- Dashboard
Route::post('getDashboard', 'HomeController@getDashboard')->name('getDashboard');
Route::post('listTraineePeriodic', 'HomeController@listTraineePeriodic')->name('listTraineePeriodic');
Route::post('listDtlTraineePeriodic', 'HomeController@listDtlTraineePeriodic')->name('listDtlTraineePeriodic');
Route::post('chartDtlTraineePeriodic', 'HomeController@chartDtlTraineePeriodic')->name('chartDtlTraineePeriodic');
Route::post('chartCityPerProv', 'HomeController@chartCityPerProv')->name('chartCityPerProv');







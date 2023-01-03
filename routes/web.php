<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/update', 'UpdateController@update');
Route::get('/','SiteController@home') ;
Route::get('/aboutUs','SiteController@about') ;
Route::get('/rule','SiteController@rule') ;
Route::get('/guide','SiteController@guide') ;
Route::get('/questions','SiteController@questions') ;
Route::get('/license','LicenseController@index') ;
Route::get('/imgView','SiteController@img_view') ;

Route::get('/ftmNews','NewsController@ftm_news') ;
Route::get('/new','NewsController@ftm_new') ;

Route::get('/forum','UpdateController@update') ;

Route::post('/register_user','UserController@send') ;

Route::get('/complaint','ComplaintController@complaint') ;
Route::post('/complaint_send','ComplaintController@send') ;

Route::get('/contactUs','ContactController@contact') ;
Route::post('/contact','ContactController@send') ;

Route::get('/complaint','ComplaintController@complaint') ;
Route::post('/complaint_send','ComplaintController@send') ;

Route::post('/video','VideoController@index') ;
Route::get('/ftmVideos','VideoController@all_video') ;

Route::get('/ftmServices','ServiceController@index') ;
Route::post('/service','ServiceController@view') ;

Route::get('/ftmGlance','GlanceController@index') ;

Route::get('/ftmImages','ImagesController@index') ;
Route::post('/image','ImagesController@view') ;
Route::post('/gallery','ImagesController@gallery') ;

Route::get('/ftmProducts','ProductController@index') ;
Route::post('/product','ProductController@view') ;

Route::get('/ftmManager','ManagerController@index') ;

Route::get('/ftmNewspapers','NewspaperController@index') ;

Route::get('/ftmReport','ReportController@index') ;

Route::get('/survey','SurveyController@index') ;
Route::post('/answers','SurveyController@send') ;

Auth::routes();

Route::prefix('admin')->middleware('admin')->namespace('Admin')->group(function (){

    Route::get('/', 'AdminController@index')->name('admin');
    Route::post('general_edit','AdminController@edit');
    Route::post('footer_edit','AdminController@footer_edit');
    Route::post('slider_edit','AdminController@slider_edit');

    Route::post('/delete_msg', 'DeleteController@delete_msg');
    Route::post('/active_msg', 'ActiveController@active_msg');
    Route::post('/inactive_msg', 'ActiveController@inactive_msg');
    Route::post('/answer_msg', 'ActiveController@answer_msg');

    Route::get('/questions', 'QuestionController@index');
    Route::post('/editQuestion', 'QuestionController@edit');
    Route::post('/question_record', 'QuestionController@record');
    Route::post('/deleteQuestion', 'QuestionController@delete');
    Route::post('/activeQuestion', 'QuestionController@active');
    Route::post('/inactiveQuestion', 'QuestionController@inactive');

    Route::get('/about', 'AboutController@index');
    Route::post('/editAbout', 'AboutController@edit');
    Route::post('/deleteAbout', 'AboutController@delete');
    Route::post('/activeAbout', 'AboutController@active');
    Route::post('/inactiveAbout', 'AboutController@inactive');

    Route::post('/deletePaper', 'AboutController@delete_paper');
    Route::post('/activePaper', 'AboutController@active_paper');
    Route::post('/inactivePaper', 'AboutController@inactive_paper');
    Route::post('/editNewspaper', 'AboutController@edit_paper');
    Route::post('/editLicense', 'AboutController@edit_license');

    Route::post('/menuOneRecord', 'AboutController@record');
    Route::post('/menuFiveRecord', 'AboutController@fiveRecord');

    Route::post('/license', 'AboutController@record_license');
    Route::post('/deleteLicenses', 'AboutController@delete_license');
    Route::post('/activeLicenses', 'AboutController@active_license');
    Route::post('/inactiveLicenses', 'AboutController@inactive_license');


    Route::get('/comment', 'CommentController@index');
    Route::post('/delete_complaint','CommentController@delete_complaint');
    Route::post('/delete_contact','CommentController@delete_contact');
    Route::post('/delete_comment','CommentController@delete_comment');
    Route::post('/complaint_message','CommentController@complaint_message');
    Route::post('/complaint_answer','CommentController@complaint_answer');
    Route::post('/contact_message','CommentController@contact_message');
    Route::post('/contact_answer','CommentController@contact_answer');
    Route::post('/comment_message','CommentController@comment_message');
    Route::post('/comment_answer','CommentController@comment_answer');

    Route::get('/news', 'NewsController@index');
    Route::post('/deleteNews','NewsController@delete');
    Route::post('/newsRecord','NewsController@record');
    Route::post('/activeNews','NewsController@active');
    Route::post('/inactiveNews','NewsController@inactive');
    Route::post('/archivesNews','NewsController@archives');
    Route::post('/nonArchiveNews','NewsController@nonArchive');
    Route::post('/editNews','NewsController@editNews');
    Route::post('/editNewsEnd','NewsController@edit');

    Route::get('/clips', 'ClipController@index');
    Route::post('/clipRecord', 'ClipController@record');
    Route::post('/deleteClips','ClipController@delete');
    Route::post('/activeClips','ClipController@active');
    Route::post('/inactiveClips','ClipController@inactive');
    Route::post('/editClips','ClipController@editClips');
    Route::post('/editClipsEnd','ClipController@edit');

    Route::get('/image', 'ImageController@index');
    Route::post('/imageRecord', 'ImageController@record');
    Route::post('/deleteImages','ImageController@delete');
    Route::post('/activeImages','ImageController@active');
    Route::post('/inactiveImages','ImageController@inactive');
    Route::post('/editImages','ImageController@editImages');
    Route::post('/editImagesEnd','ImageController@edit');

    Route::get('/service', 'ServiceController@index');
    Route::post('/serviceRecord', 'ServiceController@record');
    Route::post('/deleteServices','ServiceController@delete');
    Route::post('/activeServices','ServiceController@active');
    Route::post('/inactiveServices','ServiceController@inactive');
    Route::post('/editServices','ServiceController@editImages');
    Route::post('/editServicesEnd','ServiceController@edit');

    Route::get('/product', 'ProductController@index');
    Route::post('/productRecord', 'ProductController@record');
    Route::post('/deleteProducts','ProductController@delete');
    Route::post('/activeProducts','ProductController@active');
    Route::post('/inactiveProducts','ProductController@inactive');
    Route::post('/editProducts','ProductController@editProducts');
    Route::post('/editProductsEnd','ProductController@edit');

    Route::get('/surveys', 'SurveysController@index');
    Route::post('/surveyRecord', 'SurveysController@record');
    Route::post('/editSurvey', 'SurveysController@edit');
    Route::post('/deleteSurvey', 'SurveysController@delete');
    Route::post('/activeSurvey', 'SurveysController@active');
    Route::post('/inactiveSurvey', 'SurveysController@inactive');


    Route::post('/deleteAnswer', 'SurveysController@delete_answer');
    Route::post('/activeAnswer', 'SurveysController@active_answer');
    Route::post('/inactiveAnswer', 'SurveysController@inactive_answer');


    Route::get('/register', 'RegisterController@index');
    Route::post('/deleteUser', 'RegisterController@delete');
    Route::post('/activeUser', 'RegisterController@active');
    Route::post('/inactiveUser', 'RegisterController@inactive');
    Route::post('/editUser', 'RegisterController@edit');
    Route::post('/editUserTwo', 'RegisterController@edit_two');
    

});
Route::get('/home', 'SiteController@home') ;





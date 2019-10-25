<?php

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

Route::get('locale/{locale}', 'PageController@localization');


Auth::routes();

Route::get('/access', 'AccessLevelController@access')->name('access')->middleware('auth');

//Permission and role urls
Route::post('permission/store', 'PermissionController@storePermission');
Route::post('role/store', 'PermissionController@storeRole');
Route::post('/access/assignPermission', 'PermissionController@assignPermission')->name('access')->middleware('auth');
Route::delete('/access/removePermission', 'PermissionController@removePermission')->name('access')->middleware('auth');
Route::delete('deleteRole/{id}', 'PermissionController@deleteRole');
Route::delete('deletePermission/{id}', 'PermissionController@deletePermission');
Route::post('assignRole/{user}', 'UserController@assignRole');
Route::delete('revokeRole/{user}', 'UserController@revokeRole');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@dashboard')->name('dashboard')->middleware('auth');;
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth');
Route::get('/configuration', 'HomeController@configuration')->name('configuration');

//Search urls
Route::get('/search/public', 'searchController@searchPublic')->name('search');
Route::get('/search/detail/{knowledgeProduct}', 'searchController@searchDetail');
Route::get('/search/public/{category}', 'searchController@searchPublicCategory')->name('search');
Route::get('/search/public/flitter/{name}/{value}', 'searchController@searchFlitter')->name('search');
Route::get('/search/public/order/{column}/{order}', 'searchController@orderBy')->name('search');

//user
Route::get('userTableData', 'UserController@tableData');
Route::get('useKnowledge/{user}', 'UserController@userKnowledge');
Route::get('userActivity/{user}', 'UserController@userActivity');

Route::get('directorateUser', 'UserController@directorateUser');
Route::post('permission/store', 'PermissionController@storePermission');
Route::post('role/store', 'PermissionController@storeRole');

Route::get('resetPassword/{user}', 'UserController@resetPassword');

Route::post('resetPassword/{user}', 'UserController@updatePassword');

Route::get('documents/filter/{documentCategory}', 'DocumentController@filterDocument');

Route::Resources([
    'users' => 'UserController',
    'userStatus' => 'UserStatusController',
    'projectCategory' => 'ProjectCategoryController',
    'knowledgeCategory' => 'KnowledgeCategoryController',
    'documentCategory' => 'DocumentCategoryController',
    'mapType' => 'MapTypeController',
    'projectStatus' => 'ProjectStatusController',
    'region' => 'RegionController',
    'accessLevel' => 'AccessLevelController',
    'link' => 'LinkController',
    'slider' => 'SliderController',
    'board' => 'NoticeBoardController',
    'finance' => 'FinanceController',
    'directorate' => 'DirectorateController',
    'projects' => 'ProjectController',
    'knowledge' => 'knowledgeProductController',
    'knowledgeComment' => 'KnowledgeCommentController',
    'document' => 'DocumentController',
    'video' => 'VideoController',
    'photo' => 'PhotoController',
    'map' => 'MapController',
    'news' => 'BlogController',
    'attachment' => 'AttachmentController',
    'knowledgeRating' => 'KnowledgeRatingController',
    'contact' => 'ContactController',
    'language' => 'LanguageController',
    'unit' => 'UnitController',
]);

//Data Table Urls
Route::get('FinanceTableData', 'FinanceController@tableData');
Route::get('directorateTableData', 'directorateController@tableData');
Route::get('projectTableData', 'ProjectController@tableData');
Route::get('knowledgeTableData', 'knowledgeProductController@tableData');
Route::get('documentTableData', 'DocumentController@tableData');
Route::get('videoTableData', 'VideoController@tableData');
Route::get('photoTableData', 'PhotoController@tableData');
Route::get('mapTableData', 'MapController@tableData');
Route::get('newsTableData', 'BlogController@tableData');
Route::get('contactTableData', 'ContactController@tableData');
//End Data Table Urls

//Static Pages urls
Route::get('about', 'PageController@about');
Route::get('audit', 'PageController@audit');
Route::get('contacts', 'PageController@contacts');
Route::get('help', 'PageController@help');
//End Static Pages urls

Route::get('getAttachment/{attachment}', 'AttachmentController@getAttachment');

//Json Files
Route::get('userActivitiesJson/{user}', 'UserController@userActivityJson');

//notice board
Route::get('board/{noticeBoard}/detail', 'NoticeBoardController@detail');

//blog
Route::get('newsView', 'BlogController@newsView');
Route::get('updateStatus/{knowledgeProduct}', 'KnowledgeProductController@updateStatus');

//Approve url
Route::get('approve', 'KnowledgeProductController@approve');

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

// Route::get('/', function () {
//     return view('welcome');
// });


/**
 * Home Routes
 */
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/group/own', 'HomeController@ownGroup')->name('home.ownGroup');
Route::get('/group/search', 'HomeController@searchGroup')->name('home.searchGroup');
Route::post('/group/info/{groupId}', 'HomeController@groupInfo')->name('home.groupInfo');

Route::get('/group/edit/{groupId?}', 'HomeController@editGroup')->name('home.editGroup');
Route::post('/group/updateOrCreate/{groupId?}', 'HomeController@updateOrCreateGroup')->name('home.updateOrCreateGroup');
Route::get('/group/delete/{groupId}', 'HomeController@deleteGroup')->name('home.deleteGroup');

Route::get('/group/addinfo/{groupId}', 'HomeController@addInfo')->name('home.addInfo');
Route::post('/group/join/{groupId}', 'HomeController@joinGroup')->name('home.joinGroup');
Route::get('/group/quit/{groupId}', 'HomeController@quitGroup')->name('home.quitGroup');


Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@register')->name('register.perform');

    /**
     * Login Routes
     */
    Route::get('/login', 'LoginController@show')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login.perform');

});

Route::group(['middleware' => ['auth']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
});


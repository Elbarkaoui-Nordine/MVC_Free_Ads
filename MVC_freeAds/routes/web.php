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
    return view('welcome');
});

Route::get('index', 'IndexController@index');


Route::group(['middleware' => ['auth']], function () {
    // show edit form
    Route::get('/profile/edit', 'UserController@edit')->name('editProfile');
    // update profile
    Route::put('/profile/edit', 'UserController@update');
    //show create form
    Route::get('/ad/create', 'AnnonceController@create')->name('createAd');
    //show all ads
    Route::get('/ad/index', 'AnnonceController@index');
    //show all own ads
    Route::get('/ad/own', 'AnnonceController@userAnnonce')->name('ownAds');
    //show edit form
    Route::get('/ad/edit/{id}', 'AnnonceController@edit');
    // delete pic
    Route::delete('/ad/picture/delete/{id}','AnnoncePictureController@delete')->name('deletePic');
    //delete add
    Route::delete('/ad/delete/{annonce}','AnnonceController@delete')->name('deleteAd');
    // update ad
    Route::put('/ad/update/{annonce}', 'AnnonceController@update')->name('editAd');
    // store ad
    Route::put('/ad/store', 'AnnonceController@store')->name('adStore');

    Route::get('/search/index','AnnonceController@searchIndex');

    Route::get('/search','AnnonceController@getProducts');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




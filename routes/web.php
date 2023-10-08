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


Auth::routes();
Route::group(['prefix' => LaravelLocalization::setLocale(),

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {


});

Route::get('/', function () {
    return view('home');
});
/** General pages */
Route::get('/media', 'GeneralController@media')->name('General.media');
Route::get('/volunteer', 'GeneralController@volunteer')->name('General.volunteer');
Route::post('/saveContactUs', 'GeneralController@saveContactUs')->name('General.saveContactUs');
Route::get('/contact_us', 'GeneralController@contact_us')->name('General.contact_us');
Route::get('/about_us', 'GeneralController@about_us')->name('General.about_us');
Route::get('/Reports', 'GeneralController@Reports')->name('General.Reports');

/** Team Routes */
Route::get('/Team', 'TeamController@Team')->name('Team.Team');
Route::get('/Team/singleTeam', 'TeamController@singleTeam')->name('Team.singleTeam');
Route::get('/Team/teamWork', 'TeamController@teamWork')->name('Team.teamWork');


/** Subscribe Routes */
Route::get('/Subscribe/Active', 'SubscribeController@Active')->name('Subscribe.Active');
Route::get('/Subscribe/Associate', 'SubscribeController@Associate')->name('Subscribe.Associate');
Route::post('/Subscribe/saveSubscribe', 'SubscribeController@saveSubscribe')->name('Subscribe.saveSubscribe');


/** Blog Routes */
Route::get('/Blog', 'BlogController@Blog')->name('Blog.Blog');
Route::get('/Blog/singleBlog', 'BlogController@singleBlog')->name('Blog.singleBlog');
Route::get('/Blog/blogsByCat', 'BlogController@blogsByCat')->name('Blog.blogsByCat');
Route::get('/Blog/allBlog', 'BlogController@allBlog')->name('Blog.allBlog');
Route::get('/Blog/search', 'BlogController@search')->name('Blog.search');
Route::post('/Blog/saveComment/{id}', 'BlogController@saveComment')->name('Blog.saveComment');


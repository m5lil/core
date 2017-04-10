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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


/*-----------------------------------------------------------------------------
| DASHBOARD
|----------------------------------------------------------------------------*/
Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {

    Route::get('/', 'DashController@index');

    // -------------------------------- Pages ------------------------------ //
    Route::resource('/pages', 'PageController');
    Route::get('/pages/{id}/delete', 'PageController@destroy');
//    Route::post('/pages/ajax', 'PageController@ajax');
//    Route::post('/pages/delete', 'PageController@delete');

    // ------------------------------- Setings ----------------------------- //
    Route::get('/settings', 'SettingController@index');
    Route::post('/settings', 'SettingController@update');

    // --------------------------------- Menu ------------------------------ //
    Route::resource('/menu', 'MenuController');
    Route::get('/menu/{id}/delete', 'MenuController@destroy');
    Route::post('/menu/order', function () {
        if (Input::has('item')) {
            $i = 0;
            foreach (Input::get('item') as $id) {
                $i++;
                $item = App\Menu::find($id);
                $item->order = $i;
                $item->save();
            }
            return Response::json(array('success' => true));
        } else {
            return Response::json(array('success' => false));
        }
    });

    // -------------------------------- User ------------------------------- //
    Route::resource('/users', 'UserController');
    Route::get('/users/activate/{id}', 'UserController@activate');

    // -------------------------------- Inbox ------------------------------ //
    Route::resource('/inbox', 'InboxController');

    // ------------------------------- Subscribe ----------------------------- //
    Route::resource('/subscribers', 'SubscribersController');
    Route::get('/subscribers/{id}/delete', 'SubscribersController@delete');

    // ------------------------------- Blog ----------------------------- //
    Route::resource('/blog/categories', 'CategoryController');
    Route::get('/blog/categories/{id}/delete', 'CategoryController@destroy');

    Route::resource('/blog/posts', 'PostController');
    Route::get('/blog/posts/{id}/delete', 'PostController@destroy');

    Route::resource('/blog/comments', 'CommentController');
    Route::get('/blog/comments/{id}/delete', 'CommentController@destroy');


});
/*
|----------------------------------------------------------------------------*/

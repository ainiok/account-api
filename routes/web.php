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
Route::get('/user/list', function () {
    return new \App\Http\Resources\UserCollection(\App\Models\User::paginate());
    return response()->json([
        ['id' => 1, 'name' => '张三', 'email' => '123@qq.com'],
        ['id' => 2, 'name' => '李四', 'email' => '456@qq.com'],
        ['id' => 3, 'name' => '王五', 'email' => '789@qq.com'],
    ]);
});
Route::get('/test', 'HomeController@index');
Route::get('mail', function () {
    $user = \App\Models\User::where('email', '763303918@qq.com')->first();
    (new \App\Notifications\CaptchaNotify())->toMail($user);
});

Route::group(['guard' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
    Route::get('/index', 'LoginController@index');
    // app
    Route::post('app', 'AppController@store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

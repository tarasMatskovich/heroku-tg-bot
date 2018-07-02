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

Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin.')->group(function() {
    Route::get('/',[
        'uses' => 'DashboardController@index',
        'as' => 'index'
    ]);

    Route::get('/setting','SettingController@index')->name('setting.index');

    Route::post('/setting/store','SettingController@store')->name('setting.store');

    Route::post('setting/setwebhook','SettingController@setwebhook')->name('setting.setwebhook');
    Route::post('setting/getwebhook','SettingController@getwebhookinfo')->name('setting.getwebhook');
});

Route::post(Telegram::getAccessToken(),function() {
    Telegram::commandsHandler(true);
});

Auth::routes();

Route::match(['get','post'],'register',function(){
    Auth::logout();
    return redirect('/');
})->name('register');

Route::get('/home', 'HomeController@index')->name('home');

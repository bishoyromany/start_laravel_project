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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();


/**
 * all admin routes
 */
Route::group(['middleware' => ['\App\Http\Middleware\Admin'], 'prefix' => 'admin'], function () {
    /**
     * the dashboard
     */
    Route::get('/', 'HomeController@index')->name('admin');

    $routesContainer = [
        [
            'names' => 'users',
            'name' => 'user',
            'controller' => 'UsersController',
        ],
    ];

    foreach ($routesContainer as $r) {
        /**
         * scripts routes
         */
        Route::get('/' . $r['names'], $r['controller'] . '@index')->name($r['names']);
        // store
        Route::post('/' . $r['name'] . '/store', $r['controller'] . '@store')->name($r['name'] . '.store');
        // show
        Route::get('/' . $r['name'] . '/show/{id}', $r['controller'] . '@show')->name($r['name'] . '.show');
        // edit
        Route::get('/' . $r['name'] . '/edit/{id}', $r['controller'] . '@edit')->name($r['name'] . '.edit');
        // update
        Route::post('/' . $r['name'] . '/update/{id}', $r['controller'] . '@update')->name($r['name'] . '.update');
        // delete
        Route::post('/' . $r['name'] . '/delete/{id}', $r['controller'] . '@destroy')->name($r['name'] . '.delete');
        // export
        Route::get('/' . $r['names'] . '/export/all', $r['controller'] . '@exportAll')->name($r['names'] . '.export');
        // import
        Route::post('/' . $r['names'] . '/import', $r['controller'] . '@importJson')->name($r['names'] . '.import');
    }
});

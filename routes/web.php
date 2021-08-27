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

// Route :: get ('/', function () {
//     return Inertia\Inertia :: render ('Home');
// });

// Route::inertia('/', 'App\Http\Controllers\Inertia\FrontController@index')->name('index');

Route::get('/', 'App\Http\Controllers\Inertia\FrontController@index')->name('home');

Route::get('/page/category/{slug}', 'App\Http\Controllers\Inertia\FrontController@pageCategory')->name('page.category');

Route::get('/page/news/{slug}', 'App\Http\Controllers\Inertia\FrontController@pageNews')->name('page.news');

Route::get('/videos', 'App\Http\Controllers\FrontController@GetVideos')->name('get.videos');
Route::get('/update-videos', 'NewsController@UpdateVideos')->name('update.videos');

Route::get('/page', 'App\Http\Controllers\FrontController@pageArchive')->name('page');
Route::get('/page/search', 'App\Http\Controllers\FrontController@pageSearch')->name('page.search');

// Route::get('/about', 'FrontController@about')->name('about');
// Route::get('/contact', 'FrontController@contact')->name('contact');
// Route::get('/programs', 'FrontController@programs')->name('programs');
// route::get('/staff', 'FrontController@staff')->name('staff');
// route::get('/live', 'FrontController@live')->name('live');
// route::post('/search', 'FrontController@search')->name('search');
// CROP IMAGES
Route::post('image_crop/upload', 'App\Http\Controllers\ImageCropController@upload')->name('image_crop.upload');

// AUTHENTICATION
Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('login');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\RegisterController@register')->name('register');
Route::post('/register', 'App\Http\Controllers\RegisterController@registration')->name('register');

// SOCIAL LOGIN
Route::get('login/google', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('login.google');
Route::get('login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');

// 404
Route::get('/nopermission', function () {
    return back();
})->name('nopermission');

// ONLY ADMIN
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'roles'], 'roles' => ['admin']], function () {

    Route::resource('users', 'App\Http\Controllers\UsersController');

    Route::resource('settings', 'App\Http\Controllers\SettingController')->only(['index', 'store']);
    Route::get('settings/breakingnews', 'App\Http\Controllers\SettingController@breakingNews')->name('settings.breakingnews');
    Route::post('settings/breakingnews/store', 'App\Http\Controllers\SettingController@storeBreakingNews')->name('settings.breakingnews.store');

    Route::resource('advertisements', 'App\Http\Controllers\AdvertisementController')->only(['index', 'store']);

    Route::resource('menus', 'App\Http\Controllers\MenuController');
    Route::post('menuitems-json', 'App\Http\Controllers\MenuController@getMenuItems')->name('menuitems.json');
    Route::post('menuitemsdetails-json', 'App\Http\Controllers\MenuController@getMenuItemsDetails')->name('menuitemsdetails.json');
});

// BOTH EDITOR AND ADMIN
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'roles'], 'roles' => ['editor', 'admin']], function () {
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('news', 'App\Http\Controllers\NewsController');
});

// USER, EDITOR AND ADMIN
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['user', 'editor', 'admin']], function () {

    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    Route::get('profile', 'App\Http\Controllers\ProfileController@profile')->name('profile');
    Route::post('profile', 'App\Http\Controllers\ProfileController@profileUpdate')->name('profile.update');
    Route::post('changepassword', 'App\Http\Controllers\ProfileController@changePassword')->name('profile.changepassword');
});

// Mobile
Route::get('/mobile/{name}/{slug}', 'App\Http\Controllers\MobileController@index')->name('mobile');

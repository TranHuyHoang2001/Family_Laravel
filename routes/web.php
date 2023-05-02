<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', 'Frontend\HomeController@index')->name('dashboard');
Route::get('/job', 'Frontend\HomeController@job')->name('job');
Route::get('/introduce', 'Frontend\HomeController@introduce')->name('introduce');
Route::get('/product', 'Frontend\HomeController@product')->name('product');
Route::get('/moment', 'Frontend\HomeController@moment')->name('moment');
Route::get('/experience', 'Frontend\HomeController@experience')->name('experience');
Route::get('{id}/detail_experience', 'ExperienceController@show')->name('detail.experience');
Route::get('/contact', 'Frontend\HomeController@contact')->name('contact');
Route::get('/cart', 'Frontend\HomeController@cart')->name('cart');
Route::get('/order', 'CartController@order')->name('order');
Route::get('/checkout', 'CartController@getCheckout');
Route::post('/checkout', 'CartController@postCheckout')->name('complete');
Route::get('/complete', 'CartController@complete')->name('complete');


Route::get('/cart','CartController@cart')->name('cart');
Route::get('{id}/cart/add','CartController@add')->name('cart.add');
Route::get('{rowId}/cart/remove','CartController@remove')->name('cart.remove');
Route::get('cart/destroy','CartController@destroy')->name('cart.destroy');
route::post('cart/update','CartController@update')->name('cart.update');

Route::middleware('checklogin')->group(function () {

    /*
    Job manage
    */
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Do_An\HomeController@index')->name('home');

        Route::group(['as' => 'job.', 'prefix' => 'job'], function (){
            Route::get('/', 'Do_An\JobController@index')->name('index');
            Route::get('/create', 'Do_An\JobController@create')->name('create');
            Route::post('/store', 'Do_An\JobController@store')->name('store');
            Route::get('/{id}/edit', 'Do_An\JobController@edit')->name('edit');
            Route::put('/{id}/update', 'Do_An\JobController@update')->name('update');
            Route::delete('/{id}/delete', 'Do_An\JobController@destroy')->name('delete');
            Route::get('/report', 'Do_An\JobController@report')->name('report');
        });

        Route::group(['as' => 'user.', 'prefix' => 'user'], function (){
            Route::get('/', 'Do_An\UserController@index')->name('index');
            Route::get('/create', 'Do_An\UserController@create')->name('create');
            Route::post('/store', 'Do_An\UserController@store')->name('store');
            Route::get('/edit/{id}', 'Do_An\UserController@edit')->name('edit');
            Route::put('/update/{id}', 'Do_An\UserController@update')->name('update');
            Route::delete('/{id}', 'Do_An\UserController@destroy')->name('delete');
        });

        Route::group(['as' => 'family.', 'prefix' => 'family'], function (){
            Route::get('/', 'Do_An\FamilyController@index')->name('index');
            Route::get('/create', 'Do_An\FamilyController@create')->name('create');
            Route::post('/store', 'Do_An\FamilyController@store')->name('store');
            Route::get('/edit/{id}', 'Do_An\FamilyController@edit')->name('edit');
            Route::put('/update/{id}', 'Do_An\FamilyController@update')->name('update');
            Route::delete('/{id}', 'Do_An\FamilyController@destroy')->name('delete');
            Route::post('add-member/{id}', 'Do_An\FamilyController@addMember')->name('add_member');
            Route::get('accept-member/{id}', 'Do_An\FamilyController@accessMember')->name('accept_member');
            Route::get('/job-of-family', 'Do_An\FamilyController@jobOfFamily')->name('job_of_family');
            Route::post('/{id}/get-job', 'Do_An\FamilyController@getJob')->name('get_job');
            Route::delete('/{id}/delete-job', 'Do_An\FamilyController@deleteJob')->name('delete-job');
            Route::delete('/delete-member/{id}', 'Do_An\FamilyController@deleteMember')->name('delete_member');
            Route::get('/family-moment', 'Do_An\FamilyController@familyMoment')->name('family_moment');
            Route::get('/family-moment-create', 'Do_An\FamilyController@familyMomentCreate')->name('family_moment_create');
            Route::post('/family-moment-store', 'Do_An\FamilyController@familyMomentStore')->name('family_moment_store');
            Route::get('/family-moment-edit/{id}', 'Do_An\FamilyController@familyMomentEdit')->name('family_moment_edit');
            Route::put('/family-moment-update/{id}', 'Do_An\FamilyController@familyMomentUpdate')->name('family_moment_update');
            Route::delete('/family-moment-delete/{id}', 'Do_An\FamilyController@familyMomentDelete')->name('family_moment_delete');
            Route::get('/{id}/update-job-family', 'Do_An\FamilyController@updateJobFamily')->name('update_job_family');
            Route::post('/{id}/complete-job-family', 'Do_An\FamilyController@completeJobFamily')->name('complete_job_family');
            Route::get('/{id}/watch-job-family', 'Do_An\FamilyController@watchJobFamily')->name('watch_job_family');
            Route::get('/{id}/see-family','Do_An\FamilyController@see')->name('see_family');
        });

        Route::group(['as' => 'criteria.', 'prefix' => 'criteria'], function (){
            Route::get('/', 'Do_An\CriteriaController@index')->name('index');
            Route::get('/create', 'Do_An\CriteriaController@create')->name('create');
            Route::post('/store', 'Do_An\CriteriaController@store')->name('store');
            Route::get('/edit/{id}', 'Do_An\CriteriaController@edit')->name('edit');
            Route::put('/update/{id}', 'Do_An\CriteriaController@update')->name('update');
            Route::delete('/{id}', 'Do_An\CriteriaController@destroy')->name('delete');
        });

        Route::group(['as' => 'experience.', 'prefix' => 'experience'], function () {
            Route::get('/', 'Do_An\ExperienceController@index')->name('index');
            Route::get('/create', 'Do_An\ExperienceController@create')->name('create');
            Route::post('/store', 'Do_An\ExperienceController@store')->name('store');
            Route::get('/edit/{id}', 'Do_An\ExperienceController@edit')->name('edit');
            Route::put('/update/{id}', 'Do_An\ExperienceController@update')->name('update');
            Route::delete('/{id}', 'Do_An\ExperienceController@destroy')->name('delete');
        });
        Route::group(['as' => 'introduce_family.', 'prefix' => 'introduce-family'], function (){
            Route::get('/', 'Do_An\IntroduceFamilyController@index')->name('index');
            Route::post('/store', 'Do_An\IntroduceFamilyController@store')->name('store');
            Route::post('{id}/update', 'Do_An\IntroduceFamilyController@update')->name('update');
        });

        Route::group(['as' => 'product.', 'prefix' => 'product'], function (){
            Route::get('/', 'Do_An\ProductController@index')->name('index');
            Route::get('/create', 'Do_An\ProductController@create')->name('create');
            Route::post('/store', 'Do_An\ProductController@store')->name('store');
            Route::get('/{id}/edit', 'Do_An\ProductController@edit')->name('edit');
            Route::put('/{id}/update', 'Do_An\ProductController@update')->name('update');
            Route::delete('delete/{id}', 'Do_An\ProductController@destroy')->name('delete');



        });

        Route::group(['as' => 'honors.', 'prefix' => 'honors'], function (){
            Route::get('/', 'Do_An\HonorsController@index')->name('index');
            Route::get('/create-family', 'Do_An\HonorsController@createFamily')->name('createFamily');
            Route::get('/create-user', 'Do_An\HonorsController@createUser')->name('createUser');
            Route::post('/store', 'Do_An\HonorsController@store')->name('store');
            Route::delete('delete/{id}', 'Do_An\HonorsController@destroy')->name('delete');
        });

        Route::resource('/bill','Do_An\BillsController')->name('index','bill.index');
        Route::resource('/bill/{id}/edit','Do_An\BillsController@edit');
        Route::get('/bill/delete/{id}','Do_An\BillsController@destroy')->name('bill.delete');


        Route::get('export', 'ExportController@export')->name('bill.export');

    });
});
Route::get('/login', 'Do_An\AuthController@login')->name('login');
Route::post('/sign-in', 'Do_An\AuthController@signIn')->name('sign_in');
Route::get('/logout', 'Do_An\AuthController@logout')->name('logout');
Route::get('/register', 'Do_An\AuthController@register')->name('register');
Route::post('/post-register', 'Do_An\AuthController@postRegister')->name('post_register');
Route::get('/import', 'Do_An\ImportController@import')->name('import');
Route::post('/post-import', 'Do_An\ImportController@postImport')->name('post_import');
Route::get('/import-criteria', 'Do_An\ImportController@importCriteria')->name('import_criteria');
Route::post('/post-import-criteria', 'Do_An\ImportController@postImportCriteria')->name('post_import_criteria');

Route::get('chinh-sach-rieng-tu', function(){
     return '<h1>Chính sách riêng tư</h1>';
});

Route::get('auth/facebook', function(){
     return Socialite::driver('facebook')->redirect();
});

Route::get('auth/facebook/callback', function(){
     return 'callback login facebook';
});





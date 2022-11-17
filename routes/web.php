<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

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

Route::controller(FrontController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/recipes','recipes')->name('recipes');
    Route::get('/addRecipe','addRecipe')->name('addRecipe');
    Route::post('/insertRecipe','insertRecipe')->name('insertRecipe');
    Route::get('/recipeList','recipeList')->name('recipeList');
    Route::get('/viewRecipe/{id}','viewRecipe')->name('viewRecipe');
    Route::get('/editRecipe/{id}','editRecipe')->name('editRecipe');
    Route::put('/updateRecipe/{id}','updateRecipe')->name('updateRecipe');
    Route::get('/deleteRecipe/{id}','deleteRecipe')->name('deleteRecipe');
    Route::get('/search', 'search')->name('search');
    Route::get('/forum', 'forum')->name('forum');
    Route::get('/addForum', 'addForum')->name('addForum');
    Route::post('/saveForum', 'saveForum')->name('saveForum');
    Route::get('/forumDiscussion/{id}', 'forumDiscussion')->name('forumDiscussion');
    Route::post('/addPost', 'addPost')->name('addPost');
    Route::get('/profile', 'profile')->name('profile');
    Route::put('/updateProfile', 'updateProfile')->name('updateProfile');
    Route::get('/report', 'report')->name('report');
    Route::get('/deleteUser/{id}', 'deleteUser')->name('deleteUser');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/admin/login', 'adminLogin')->name('adminLogin');
    Route::get('/recipeStatus', 'recipeStatus')->name('recipeStatus');
    Route::get('/favorite', 'favorite')->name('favorite');
    Route::get('/favoriteList', 'favoriteList')->name('favoriteList');
    Route::get('/ratings', 'ratings')->name('ratings');
    Route::get('/deleteForam/{id}', 'deleteForam')->name('deleteForam');
    Route::get('/deleteFav/{id}', 'deleteFav')->name('deleteFav');
    Route::post('/reportSearch', 'reportSearch')->name('reportSearch');
    

});

Auth::routes();
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');
// Route::get('/reset-password/{token}', function ($token) {
//     return view('auth.reset-password', ['token' => $token]);
// })->middleware('guest')->name('password.reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

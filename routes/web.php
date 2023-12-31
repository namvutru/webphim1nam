<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;

//admin
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/',[IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class, 'category'])->name('category');
Route::get('/quoc-gia/{slug}',[IndexController::class, 'country'])->name('country');
Route::get('/the-loai/{slug}',[IndexController::class, 'genre'])->name('genre');
Route::get('/phim/{slug}',[IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}',[IndexController::class, 'watch']);
Route::get('/tap-phim',[IndexController::class, 'episode'])->name('episode');
Route::post('/update-year-phim',[MovieController::class,'update_year']);
Route::get('/update-topview',[MovieController::class,'update_topview']);
Route::get('/filter-topview',[MovieController::class,'filter_topview']);
Route::post('/update-season',[MovieController::class,'update_season']);
Route::get('/filter-movie',[IndexController::class,'filter'])->name('filter_movie');

Route::get('/tim-kiem',[IndexController::class, 'search'])->name('tim-kiem');

Route::get('/nam/{year}',[IndexController::class,'year']);
Route::get('/tag/{tag}',[IndexController::class,'tag']);

Route::get('/select-movie',[EpisodeController::class,'select_movie'])->name('select-movie');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('resorting',[CategoryController::class,'resorting'])->name('resorting');
Route::resource('category', CategoryController::class);
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('episode', EpisodeController::class);
Route::resource('movie',MovieController::class);
Route::resource('info', InfoController::class);

Route::get('/episodebymovie/{movie_id}',[EpisodeController::class ,'episodebymovie'])->name('episodebymovie');
//api
Route::get('/get-list-movie-leech-from-api/{page}',[ApiController::class,'getDataFromApi'])->name('getphimleech');
Route::get('/get-movie-leech/{slug}',[ApiController::class,'getmoviebyslug'])->name('getmoviebyslug');
Route::get('/search-movie-leech',[ApiController::class,'searchmoviebyslug'])->name('searchmoviebyslug');
Route::post('/synx-phim',[ApiController::class,'synxphim'])->name('synx-phim');
Route::post('/editbyslug',[MovieController::class,'editbyslug'])->name('editbyslug');
Route::get('/search',[MovieController::class,'search'])->name('search');

Route::post('/synx-phim-by-page',[ApiController::class,'synx_phim_by_page'])->name('synx-phim-by-page');
Route::get('/hide18',[ApiController::class,'tatphim18'])->name('hide18');
Route::get('/hidevn',[ApiController::class,'tatphimvn'])->name('hidevn');
Route::get ('/create-sitemap',function (){
    return Artisan::call('sitemap:create');
});

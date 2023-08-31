<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
//All Listings
Route::get('/', [ListingController::class,'index']);

//Show Create Form
Route::get('/listings/create', [ListingController::class,'create'])->middleware('auth'); //authenticate middleware redirectTo method

//Store Listing Data
Route::post('/listings', [ListingController::class,'store'])->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class,'edit'])->middleware('auth');

//Update Listing
Route::put('/listings/{listing}', [ListingController::class,'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class,'destroy'])->middleware('auth');

//Manage Listings
Route::get('/listings/manage', [ListingController::class,'manage'])->middleware('auth');

//Single Listing
Route::get('/listing/{listing}', [ListingController::class,'show']);

//Show Create/Register Form
Route::get('/register', [UserController::class,'create'])
->middleware('guest'); //In Providers, RouteServiceProvider change home path to '/'

//Create New User
Route::post('/users', [UserController::class,'store'])->middleware('guest');

//Log User Out
Route::post('/logout', [UserController::class,'logout'])->middleware('auth');

//Show Login Form
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('guest');

//Login User
Route::post('/users/authenticate', [UserController::class,'authenticate'])->middleware('guest');

// Route::get('/hello', function () {
//     //return '<h1>Hello World</h1>';
//     return response('<h1>Hello World</h1>',200)->header('Content-Type','text/plain')
//     ->header('foo','bar');
// });
// Route::get('/posts/{id}', function ($id) {
//     //ddd($id); //die, dump and debug
//     return response('<h1>Post '.$id.'</h1>');
// })->where('id','[0-9]+'); //where can be used to add constraint regex
// Route::get('/search', function (Request $req) {
//     //dd($req);
//     return $req->name .' '.$req->city;
// });

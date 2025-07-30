<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\listings;  //or use 'listings'=> App\Models\listings::all() at the route
Route::get('/',[ListingController::class,'index'] );


//show create form
Route::get('/listings/create', [ListingController::class,'create'])->middleware('auth');

//this store listing gigs
Route::post('/listings',[ListingController::class, 'store'])->middleware('auth');
//show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
// update form
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
// delete form
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
//single listing
Route::get('/listings/{listing}',[ListingController::class, 'show'])->middleware('guest');
//show register create form
Route::get('/register', [UserController::class,'create'])->middleware('guest');
//create new users
Route::post('/users', [UserController::class, 'store']);
//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);





/*Route::get('/hello', function(){
    return response("<h1>hello</h1>");
});

Route::get('/posts/{id}',function($id){
    //dd($id); this is die and dump method for debugging 
    //ddd(id); this is dump , die and debug method for debugging
    return response('posts'.$id);
})->where('id','[0-9]+');

Route::get('/search',function(Request $request){
    return $request->name.' '.$request->city;
});*/
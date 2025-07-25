<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\listings;  //or use 'listings'=> App\Models\listings::all() at the route
Route::get('/',[ListingController::class,'index'] );


//show create form
Route::get('/listings/create', [ListingController::class,'create']);

//this store listing gigs
Route::post('/listings',[ListingController::class, 'store']);


//single listing
Route::get('/listings/{listing}',[ListingController::class, 'show']);








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
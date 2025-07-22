<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function(){
    return response("<h1>hello</h1>");
});

Route::get('/posts/{id}',function($id){
    //dd($id); this is die and dump method for debugging 
    //ddd(id); this is dump , die and debug method for debugging
    return response('posts'.$id);
})->where('id','[0-9]+');

Route::get('/search',function(Request $request){
    return $request->name.' '.$request->city;
});
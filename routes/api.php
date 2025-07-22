<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/posts',function() {
    // Your logic to handle posts
    return response()->json([
       'posts'=>[
        'title'=>'post one'
       ]
    ]);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

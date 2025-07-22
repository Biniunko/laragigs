<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
Route::get('/posts',function(){
    return response()->json([
        'posts' => [
            'title'=>'post one'
            ]
        ]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
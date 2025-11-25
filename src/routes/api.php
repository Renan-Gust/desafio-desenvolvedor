<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UploadController;

Route::group(['prefix' => '/user'], function () {
    Route::post('/create', [AuthController::class, 'register'])->name('user.create');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => '/upload'], function () {
        Route::post('/', [UploadController::class, 'store'])->name('upload.store');
        Route::get('/', [UploadController::class, 'searchUploads'])->name('upload.search');
        Route::get('/content', [UploadController::class, 'searchContents'])->name('upload.search.content');
    });
});

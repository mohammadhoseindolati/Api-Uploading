<?php

use Dolati\Uploader\Controllers\UploaderController;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->prefix('api/uploader')->name('uploader.')->group(function () {

    Route::post('store' , [UploaderController::class , 'store']);

});

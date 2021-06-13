<?php

use App\Http\Controllers\FoldersController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\SiteImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('folders', FoldersController::class)->only('index', 'store', 'update', 'destroy');
Route::patch('folder-sorts', [FoldersController::class, 'updateFolderSorts']);
Route::resource('sites', SitesController::class)->only('store', 'update', 'destroy');
Route::patch('site-sorts', [SitesController::class, 'updateSiteSorts']);
Route::resource('site-image', SiteImageController::class)->only('store', 'show');

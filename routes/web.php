<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('line-chart', [ChartController::class, 'showChart']);
Route::post('print_chart ', [ChartController::class, 'rel']);
<?php

use App\Http\Controllers\API\guruController;
use App\Http\Controllers\API\mapelController;
use App\Http\Controllers\API\siswaController;
use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {
    //ROute Guru
    route::get('guru', [guruController::class, 'index']);
    route::get('guru/{id}', [guruController::class, 'show']);
    Route::post('guru', [guruController::class, 'store']);
    route::patch('guru/{id}', [guruController::class, 'update']);
    route::delete('guru/{id}', [guruController::class, 'destroy']);


    //Route Mapel
    route::get('mapel', [mapelController::class, 'index']);
    route::get('mapel/{id}', [mapelController::class, 'show']);
    Route::post('mapel', [mapelController::class, 'store']);
    route::patch('mapel/{id}', [mapelController::class, 'update']);
    route::delete('mapel/{id}', [mapelController::class, 'destroy']);

    //Route Siswa
    route::get('siswa', [siswaController::class, 'index']);
    route::get('siswa/{id}', [siswaController::class, 'show']);
    Route::post('siswa', [siswaController::class, 'store']);
    route::patch('siswa/{id}', [siswaController::class, 'update']);
    route::delete('siswa/{id}', [siswaController::class, 'destroy']);

    //relasi
    Route::get('guruR', [guruController::class, 'indexRelasi']);
    Route::get('mapelR', [mapelController::class, 'indexRelasi']);
    Route::get('siswaR', [mapelController::class, 'indexRelasisiswa']);



});


Route::group(['middleware' => 'api','auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);


    Route::get('password', function () {
        return bcrypt('admin123');
    });

});

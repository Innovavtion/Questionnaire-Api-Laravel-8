<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Api\AuthController;

use \App\Http\Controllers\Api\PollsController;
use \App\Http\Controllers\Api\QuestionsController;
use \App\Http\Controllers\Api\VariantAnswersController;
use \App\Http\Controllers\Api\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResources([
//     'polls' => PollsController::class,
//     'polls/{poll}/questions' => QuestionsController::class,
//     'polls/{poll}/questions/{question}/variant-answers' => VariantAnswersController::class,
// ]);

Route::get('/', function () {
   return 'Главная страница';
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResources([
        'polls' => PollsController::class,
        'polls/{poll}/questions' => QuestionsController::class,
        'polls/{poll}/questions/{question}/variant-answers' => VariantAnswersController::class,
        'users' => UserController::class
    ]);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::delete('/logout', [AuthController::class, 'logout']);
});

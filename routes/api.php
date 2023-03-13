<?php

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

Route::post('login', [\App\Http\Controllers\ApiController::class, 'authenticate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('roles', App\Http\Controllers\API\RoleAPIController::class);


Route::resource('courses', App\Http\Controllers\API\CourseAPIController::class);


Route::resource('lessons', App\Http\Controllers\API\lessonAPIController::class);


Route::resource('contents', App\Http\Controllers\API\ContentAPIController::class);


Route::resource('questions', App\Http\Controllers\API\QuestionAPIController::class);

Route::get('questions/get_question_answers/{content_id}', [App\Http\Controllers\API\QuestionAPIController::class, "getQuestionAnswer"]);
Route::post('questions/check_answer', [App\Http\Controllers\API\QuestionAPIController::class, "checkAnswer"]);

Route::post("questions/error_code_log/create", [App\Http\Controllers\ErrorCodeLogController::class, "create"]);

Route::post("questions/exercise_code_log/create", [App\Http\Controllers\ExerciseCodeLogController::class, "create"]);


Route::get("dashboard/get_chart_data", [App\Http\Controllers\API\DashboardAPIController::class, "getChartData"]);


Route::resource('badge_settings', App\Http\Controllers\API\BadgeSettingAPIController::class);
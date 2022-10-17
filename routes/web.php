<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// use App\Http\Controllers\PagesController;

// routes/web.php

Route::group([
    'prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'App\Http\Controllers\PagesController@index');
    Route::get('/about', 'App\Http\Controllers\PagesController@about');
    Route::get('/features', 'App\Http\Controllers\PagesController@features');
    Route::get('/faqs', 'App\Http\Controllers\PagesController@faqs');
    

    Route::resource('quizzes', 'App\Http\Controllers\QuizzesController');


    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/filter', 'App\Http\Controllers\HomeController@filter');


    Route::get('/test', 'App\Http\Controllers\PagesController@test');
    Route::get('/questionBank', 'App\Http\Controllers\QuestionBankController@index');
    Route::post('/questionBank/filter', 'App\Http\Controllers\QuestionBankController@filter');

    Route::get('/questionBank/createCourse', 'App\Http\Controllers\coursesController@createCourse');
    Route::post('/questionBank/store', 'App\Http\Controllers\coursesController@store');

    Route::get('/questionBank/createMCQ', 'App\Http\Controllers\QuestionBankController@createMCQ');
    Route::post('/questionBank/saveMCQ', 'App\Http\Controllers\QuestionBankController@storeMCQ');
    Route::get('/questionBank/createTF', 'App\Http\Controllers\QuestionBankController@createTF');
    Route::post('/questionBank/saveTF', 'App\Http\Controllers\QuestionBankController@storeTF');
    Route::get('/questionBank/show/{id}', 'App\Http\Controllers\QuestionBankController@show');
    Route::get('/questionBank/edit/{id}', 'App\Http\Controllers\QuestionBankController@edit');
    Route::post('/questionBank/updateMCQ/{id}', 'App\Http\Controllers\QuestionBankController@updateMCQ');
    Route::post('/questionBank/updateTF/{id}', 'App\Http\Controllers\QuestionBankController@updateTF');
    Route::delete('/questionBank/destroyMCQ/{id}', 'App\Http\Controllers\QuestionBankController@destroyMCQ');
    Route::delete('/questionBank/destroyTF/{id}', 'App\Http\Controllers\QuestionBankController@destroyTF');


    Route::get('/questions', 'App\Http\Controllers\QuestionController@index');
    Route::get('/questions/createMCQ/{id}', 'App\Http\Controllers\QuestionController@createMCQ');
    Route::post('/questions/saveMCQ/{id}', 'App\Http\Controllers\QuestionController@storeMCQ');
    Route::get('/questions/createTF/{id}', 'App\Http\Controllers\QuestionController@createTF');
    Route::post('/questions/saveTF/{id}', 'App\Http\Controllers\QuestionController@storeTF');
    Route::get('/question/show/{id}', 'App\Http\Controllers\QuestionController@show');
    Route::get('/questions/edit/{id}', 'App\Http\Controllers\QuestionController@edit');
    Route::post('/questions/updateMCQ/{id}', 'App\Http\Controllers\QuestionController@updateMCQ');
    Route::post('/questions/updateTF/{id}', 'App\Http\Controllers\QuestionController@updateTF');
    Route::delete('/questions/destroyMCQ/{id}', 'App\Http\Controllers\QuestionController@destroyMCQ');
    Route::delete('/questions/destroyTF/{id}', 'App\Http\Controllers\QuestionController@destroyTF');
    Route::get('/questions/importToBank/{id}', 'App\Http\Controllers\QuestionController@importToBank');

    Route::get('/answer/create/{id}', 'App\Http\Controllers\AnswersController@create');
    Route::post('/answer/storeAnswer/{id}', 'App\Http\Controllers\AnswersController@store');

    Route::post('/questionBank/importMCQ', 'App\Http\Controllers\QuestionBankController@importQuestionMCQ');
    Route::get('/questionBank/import/{id}', 'App\Http\Controllers\QuestionBankController@import');
    Route::post('/questionBank/importTF', 'App\Http\Controllers\QuestionBankController@importQuestionTF');


    Route::post('/quiz/saveCode/{id}', 'App\Http\Controllers\QuizzesController@saveCode');
    Route::get('/quiz/result/{id}', 'App\Http\Controllers\QuizzesController@showResult');
    // Route::get('/quiz/result/{id}', 'App\Http\Controllers\QuizzesController@showResultGb');
    Route::get('/quiz/resetResult/{id}', 'App\Http\Controllers\QuizzesController@resetResult');
    Route::get('/quiz/deactivate/{id}', 'App\Http\Controllers\QuizzesController@deactivateQuiz');
    

    Route::post('/quiz/storeName/{id}', 'App\Http\Controllers\ActiveQuizController@storeName');
    Route::get('/quiz/takeQuiz/{id}', 'App\Http\Controllers\ActiveQuizController@takeQuiz');
    Route::post('/quiz/calcScore/{id}', 'App\Http\Controllers\ActiveQuizController@calcScore');
    Route::post('/quiz/calcScoreGameBased/{id}', 'App\Http\Controllers\ActiveQuizController@calcScoreGameBased');
    Route::post('/quiz/checkCode', 'App\Http\Controllers\ActiveQuizController@checkCode');

    Route::resource('course', 'App\Http\Controllers\coursesController');

    Route::get('/{code}', 'App\Http\Controllers\ActiveQuizController@createName');
});


/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

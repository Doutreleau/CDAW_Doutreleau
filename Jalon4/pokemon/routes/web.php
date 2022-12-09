<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/pokemons','App\Http\controllers\listePokemonsController@index');
Route::get('/','App\Http\controllers\listePokemonsController@welcome');
Route::get('/user','App\Http\controllers\listePokemonsController@userPage');

Route::get('/param','App\Http\controllers\listePokemonsController@parametersPage');
Route::get('/namechange','App\Http\controllers\ParametersChange@getChangeName');
Route::post('/namechange','App\Http\controllers\ParametersChange@changeName');
Route::get('/mailchange','App\Http\controllers\ParametersChange@getChangeMail');
Route::post('/mailchange','App\Http\controllers\ParametersChange@changeMail');
Route::get('/passwordchange','App\Http\controllers\ParametersChange@getChangePassword');
Route::post('/passwordchange','App\Http\controllers\ParametersChange@changePassword');


Route::get('/choiceSecondUser','App\Http\controllers\CombatController@choiceSecondUser');
Route::post('/loginSecondUser','App\Http\controllers\CombatController@loginSecondUser');
Route::post('/choicePokemonUser1','App\Http\controllers\CombatController@choicePokemonUser1');
Route::post('/choicePokemonUser2','App\Http\controllers\CombatController@choicePokemonUser2');
Route::post('/doRound','App\Http\controllers\CombatController@doRound');

Route::get('/register', 'App\Http\controllers\RegistrationController@create');
Route::post('register', 'App\Http\controllers\RegistrationController@store');

Route::get('/login', 'App\Http\controllers\SessionsController@create');
Route::post('/login', 'App\Http\controllers\SessionsController@store');
Route::get('/logout', 'App\Http\controllers\SessionsController@destroy');


//Controller : afficher un paramètre
//Route::get('/{param}','App\Http\controllers\listePokemonsController@show');


/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
//Hello World examples:
Route::get('/', function () {
    return "Hello World!";
 });
 
Route::get('/', function () {
   echo "Hello World";
});*/

/*Ajout d'options
Route::get('/{prenom}/{nom}', function () { //ex d'appel : http://localhost:8000/myName/mySurname
    return "Hello!";
 });
 */

 /*
//prendre un paramètre "title" constitué uniquement de lettres, et l'afficher
Route::get('/{title}', function ($title) {
    return $title;
 })->where("title",'[A-Za-z]+');
*/

/*
//Appel à la vue
Route::get('/', function () {
    return view('test');
});
*/

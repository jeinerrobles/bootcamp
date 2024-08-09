<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//////////////////////////////////FORMA FACIL DE SOLO DEVOLVER UNA RUTA Y ASIGNARLE UN NOMBRE///////////////////
Route::view('/', 'welcome')->name('welcome');


///////////////////////////////////////RUTA BASE///////////////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});


////////////////////////////////////////RUTAS PARA AUTENTICACION/////////////////////////////////////////

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () { //SE DEFINE GRUPO DE RUTAS ES DECIR QUE TODAS ESTAS RUTAS VAN A HEREDAR EL MIDDLEWARE guest
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //////////////////////////////////////////GET//////////////////////////////////////
    Route::get('/chirps', [ChirpController::class, 'index'])
        ->name('chirps.index'); //RUTA CON NOMBRE ASIGNADO POR SI EL NOMBRE DE LA URL CAMBIA, NO HAY NECESIDAD DE CAMBIAR LA REDIRECCION DONDE SE LLAME

    ////////////////////////////////////////////POST///////////////////////////////////
    Route::post('/chirps', [ChirpController::class, 'store'])
    ->name('chirps.store');


////////////////////////////////////RUTA CON PARAMETRO OBLIGATORIO//////////////////////////////
    Route::get('/chirps/{chirp}', function ($chirp) { //PARAMETROS OBLIGATORIO
        if ($chirp == '2') {
            //return redirect()->route('chirps.index'); //CON LA FUNCION redirect() REDIRECCIONAMOS A OTRA RUTA
            return to_route('chirps.index'); //CON LA FUNCION to_route() REDIRECCIONAMOS A OTRA RUTA
        }
        return 'Chirp detail ' . $chirp;
    });

    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');

    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');

    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');

///////////////////////////////////RUTA CON PARAMETRO OPCIONAL//////////////////////////////////
//Route::get('/chirps/{chirp?}', function ($chirp = null) { //PARAMETROS OPCIONALES
//    if ($chirp == '2') {
//        return redirect('/chirps'); //CON LA FUNCION REDIRECT REDIRECCIONAMOS A OTRA RUTA
//    }
//    return 'Chirp detail ' . $chirp;
//});
});

require __DIR__.'/auth.php';

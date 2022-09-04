<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

// Middlewares
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Middleware\Cors;

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

// RUTAS DE PRUEBA
Route::get('/', function () {
    return "<h1>Hola mundo con Laravel</h1>";
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/pruebas/{nombre?}', function ($nombre = null) {

    $texto = "<h2>Texto desde una ruta</h2>";
    $texto .= 'Nombre: '.$nombre;

    return view('pruebas', array(
        'texto' => $texto
    ));
});

Route::get('/animales', [PruebasController::class, 'index']);
Route::get('/test-orm', [PruebasController::class, 'testOrm']);

// RUTAS DEL API

/*METODOS HTTP comunes

* GET: Conseguir datos o recursos
* POST: Guardar datos o recursos o hacer logica desde un formulario
* PUT: Actualizar datos o recursos
* DELETE: Eliminar datos o recursos

*/

// Rutas de prueba
// Route::get('/usuario/pruebas', [UserController::class, 'pruebas']);
// Route::get('/categoria/pruebas', [CategoryController::class, 'pruebas']);
// Route::get('/entrada/pruebas', [PostController::class, 'pruebas']);

// Rutas del controlador de usuarios
Route::post('/api/register', [UserController::class, 'register'])->middleware(Cors::class);
Route::post('/api/login', [UserController::class, 'login']);
Route::put('/api/user/update', [UserController::class, 'update']);
Route::post('/api/user/upload', [UserController::class, 'upload'])->middleware(ApiAuthMiddleware::class);
Route::get('/api/user/avatar/{filename}', [UserController::class, 'getImage']);
Route::get('/api/user/detail/{id}', [UserController::class, 'detail']);

// Rutas del controlador de categorias
Route::resource('/api/category', CategoryController::class);

// Rutas del controlador de posts
Route::resource('/api/post', PostController::class);
Route::post('/api/post/upload', [PostController::class, 'upload']);
Route::get('/api/post/image/{filename}', [PostController::class, 'getImage']);
Route::get('/api/post/category/{id}', [PostController::class, 'getPostsByCategory']);
Route::get('/api/post/user/{id}', [PostController::class, 'getPostsByUser']);

<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
/* Route::get('/logout', [LogoutController::class, 'store'])->name('logout'); */ //funcion pero se cambia a post para mas seguridad
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//RUTAS PARA EDITAR EL PERFIL DE USUARIO
Route::get('/editar-perfil', [PerfiController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfiController::class, 'store'])->name('perfil.store');

/* POSTS */
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

/* COMENTARIOS */
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

/* IMAGENES */
Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

// LIKE A LAS FOTOS
Route::post('posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

/* POSTS */
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

//SIGUIENDO USUARIOS
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');




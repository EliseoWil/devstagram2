<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {   
        //para arreglar cisualizacion de publicaciones solo para autenticados
        $this->middleware('auth');
    }

    public function __invoke()
    {
        //obtener a quienes seguimos
        $ids = (auth()->user()->followings->pluck('id')->toArray());
        //LATEST-> para mostrar de la ultima publicacion a la mas antigua = order desc
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(4);
        return view('home', [
            'posts' => $posts
        ]);
    }
}

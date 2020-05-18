<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id','desc')->take(6)->get();
        return view('home',['posts' => $posts]);   
    }
}

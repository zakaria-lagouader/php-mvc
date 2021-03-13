<?php

namespace Controllers;

use App\Request;
use App\View;
use Models\Post;

class HomeController {
    public function index()
    {
        $posts = Post::all();
        View::page("index", ['posts' => $posts]);
    }

    public function create(Request $request)
    {
        $post = Post::create($request->toArray());
        if ($post->save()) {
            header('Location: /');
        }else { 
            echo "Can't create user";
        }
    }
    public function test()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->delete();
        }
        header('Location: /');
    }
}
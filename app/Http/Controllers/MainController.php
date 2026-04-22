<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $json = file_get_contents(public_path('articles.json'));
        $articles = json_decode($json, true);

        return view('home', ['articles' => $articles]);
    }

    public function galery($id)
    {
        $json = file_get_contents(public_path('articles.json'));
        $articles = json_decode($json, true);

        $article = null;
        foreach ($articles as $item) {
            if ((int) $item['id'] === (int) $id) {
                $article = $item;
                break;
            }
        }

        abort_if($article === null, 404);

        return view('galery', ['article' => $article]);
    }
}

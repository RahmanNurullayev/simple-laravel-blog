<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Article;
use App\models\Category;
use App\models\Page;

class Dashboard extends Controller
{
    public function index(){
        $article=Article::all()->count();
        $hit=Article::sum('hit');
        $category=Category::all()->count();
        $page=Page::all()->count();
        return view('back.dashboard',compact('article','hit','category','page'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Traits\MapNews;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Inertia\FrontController;

class ApiController extends Controller
{
    use MapNews;
    public function posts()
    {
        $latest_news = News::latest()->where('status', 1)->paginate(5)
        ->map(function($news) {
            return MapNews::news($news);
        });
        return $latest_news;
    }

    public function read(News $news)
    {
        return MapNews::news($news);
    }

    public function category()
    {
        return Category::all();
    }

    public function post_category(Category $category)
    {
        $news = $category->newslist()->paginate(10)
            ->map(function($news) {
                return MapNews::news($news);
            });
        return $news;
    }
}

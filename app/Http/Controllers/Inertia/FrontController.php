<?php

namespace App\Http\Controllers\Inertia;

use App\Models\News;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $latest_news = News::latest()->where('status', 1)->take(20)->get()
        ->map(function($news) {
            return $this->maped_news_data($news);
        });

        $topnewslist = $latest_news->take(9);
        $catone = $latest_news->skip(9)->take(3);
        $catwo = $latest_news->skip(12)->take(2);
        $cathree = $latest_news->skip(14)->take(4);

        return Inertia::render('Home', ['newsdata' => \compact('topnewslist', 'catone', 'catwo', 'cathree')]);
    }

    public function pageCategory($slug)
    {
        $newscategorylist = $this->news_category($slug);
        return Inertia::render('Category', ['categories' => \compact('newscategorylist')]);
    }

    public function pageNews($slug)
    {
        $current_news = News::with('category')->where('slug', $slug)->first();
        $newssingle = $this->maped_news_data($current_news);

        $catnews = News::latest()->where('status', 1)->where('category_id', $current_news->category_id)
        ->take(5)->get()->map(function($news) {
            return $this->maped_news_data($news);
        });

        $newssessionkey = 'news-' . $current_news->id;

        if (!session()->has($newssessionkey)) {
            $current_news->increment('view_count');
            session()->put($newssessionkey, 1);
        }

        $og_tags = [
            'pg_title'         =>  $newssingle['imgalt'],
            'og_title'         =>  $newssingle['title'],
            'og_description'   =>  $newssingle['detailshome'],
            'og_url'           =>  $newssingle['url'],
            'og_image'         =>  $newssingle['image'],
        ];

        return Inertia::render('Single', ['read' => \compact('newssingle', 'catnews')])
        ->withViewData($og_tags);
    }

    public function news_category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $newscategorylist   = $category->newslist()->where('status', 1)->orderBy('id', 'desc')->get()->map(function($news) {
                return $this->maped_news_data($news);
            });
        } else {
            $newscategorylist   = [];
        }

        return $newscategorylist;
    }

    public function maped_news_data($news)
    {
        return [
            'id'            => $news->id,
            'title'         => Str::title($news->title),
            'titlehundred'  => Str::title(Str::limit($news->title, 100, $end = '...')),
            'titlesixty'    => Str::title(Str::limit($news->title, 60, $end = '...')),
            'titlefifty'    => Str::title(Str::limit($news->title, 55, $end = '...')),
            'slug'          => $news->slug,
            'detailshome'   => ucfirst( Str::limit($news->SanitizeDetailsHome(), 300, $end = ' ...') ),
            'detailsread'   => $news->SanitizeDetails(),
            'catname'       => $news->category->name,
            'imgalt'        => Str::title(Str::limit($news->title, 10, $end = '...')),
            'url'           => url()->current(),
            'image'         => asset('/images/news/' .$news->image),
            'imagemd'       => asset('/images/news/md-' .$news->image),
            'imagesm'       => asset('/images/news/sm-'. $news->image),
            'time'          => date('d/m/Y - h:i A', strtotime($news->created_at)),
            'author'        => $news->author
        ];
    }
}

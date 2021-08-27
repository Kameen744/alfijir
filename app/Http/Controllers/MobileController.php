<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Video;
use App\Models\Category;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MobileController extends Controller
{
    //  Mobile
    public function index($name, $slug)
    {
        $route_name = 'Mobile' . ucfirst($name);
        if ($slug === 'nill') {
            return $this->$route_name();
        } else {
            return $this->$route_name($slug);
        }
    }

    public function MobileLive()
    {
        $news_categories = Category::all();
        return view('frontend.mobile.live', compact('news_categories'));
    }

    public function MobileVideos()
    {
        $videos = Video::orderBy('publishTime', 'desc')->paginate(16);
        $news_categories = Category::where('status', 1)->get();

        return view('frontend.mobile.videos', compact('videos', 'news_categories'));
    }

    public function MobileSearch(Request $request)
    {
        $request->validate([
            'searchnews' => 'required|string'
        ]);

        $news_categories = Category::all();

        $search = $request->searchnews;

        $newssearch = News::with('category')->where('title', 'like', '%' . $search . '%')->whereHas('category')->where('status', 1)->get();

        return view('frontend.mobile.search', compact('newssearch', 'news_categories'));
    }

    public function MobileRead($slug)
    {
        $newssingle = News::with('category')->where('slug', $slug)->first();
        $news_categories = Category::where('status', 1)->get();
        $catnews = News::latest()->where('status', 1)->where('category_id', $newssingle->category_id)->take(5)->get();
        $newssessionkey = 'news-' . $newssingle->id;
        if (!session()->has($newssessionkey)) {
            $newssingle->increment('view_count');
            session()->put($newssessionkey, 1);
        }

        return view('frontend.mobile.single', compact('newssingle', 'news_categories', 'catnews'));
    }

    public function MobileCategory($slug)
    {
        $news_categories = Category::where('status', 1)->get();

        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $featurednewslist   = $category->newslist()->where('status', 1)->where('featured', 1)->take(5)->get();
            $newscategorylist   = $category->newslist()->where('status', 1)->get();
            $advertisements     = Advertisement::where('type', 'category')->where('slug', $slug)->first();
        } else {
            $featurednewslist   = [];
            $newscategorylist   = [];
            $advertisements     = [];
        }

        return view('frontend.mobile.category', compact('news_categories', 'category', 'featurednewslist', 'newscategorylist', 'advertisements'));
    }

    public function MobileHome()
    {
        $topnewslist = News::latest()->where('status', 1)->take(5)->get();
        $news_categories = Category::where('status', 1)->get();

        $newscategory_one = News::latest()->where('status', 1)->skip(5)->take(4)->get();
        $newscategory_two = News::latest()->where('status', 1)->skip(9)->take(2)->get();

        $newscategory_three = News::latest()->where('status', 1)->skip(11)->take(4)->get();

        $newscategory_four = News::latest()->where('status', 1)->skip(15)->take(4)->get();

        return view('frontend.mobile.index', compact(
            'topnewslist',
            'news_categories',
            'newscategory_one',
            'newscategory_two',
            'newscategory_three',
            'newscategory_four'
        ));
    }
}

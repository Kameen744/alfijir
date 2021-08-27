<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\Advertisement;
use App\Models\Video;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\json_encode;

class FrontController extends Controller
{

    public function index()
    {

        $topnewslist = News::latest()->where('status', 1)->take(9)->get();
        $news_categories = Category::where('status', 1)->get();

        $newscategory_one = News::latest()->where('status', 1)->skip(9)->take(3)->get();
        $newscategory_two = News::latest()->where('status', 1)->skip(12)->take(2)->get();

        $newscategory_three = News::latest()->where('status', 1)->skip(14)->take(4)->get();

        // $newscategory_four = News::latest()->where('status', 1)->skip(19)->take(4)->get();

        return view('frontend.index', compact(
            'topnewslist',
            'news_categories',
            'newscategory_one',
            'newscategory_two',
            'newscategory_three'
            // 'newscategory_four'
        ));
    }


    public function pageCategory($slug)
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

        return view('frontend.pages.category', compact('news_categories', 'category', 'featurednewslist', 'newscategorylist', 'advertisements'));
    }

    public function pageNews($slug)
    {
        $newssingle = News::with('category')->where('slug', $slug)->first();
        $news_categories = Category::all();
        $catnews = News::latest()->where('status', 1)->where('category_id', $newssingle->category_id)->take(5)->get();
        $newssessionkey = 'news-' . $newssingle->id;
        if (!session()->has($newssessionkey)) {
            $newssingle->increment('view_count');
            session()->put($newssessionkey, 1);
        }

        return view('frontend.pages.single', compact('newssingle', 'news_categories', 'catnews'));
    }

    public function pageSearch()
    {
        $search = request()->input('search');

        $newssearch = News::with('category')->where('title', 'like', '%' . $search . '%')->whereHas('category')->where('status', 1)->get();

        return view('frontend.pages.search', compact('newssearch'));
    }

    public function pageArchive()
    {
        $newsarchives = Category::with('newslist')->whereHas('newslist')->get();

        return view('frontend.pages.index', compact('newsarchives'));
    }

    public function about(Request $request)
    {
        $news_categories = Category::all();
        return view('frontend.pages.about', compact('news_categories'));
    }

    public function contact(Request $request)
    {
        $news_categories = Category::all();
        return view('frontend.pages.contact', compact('news_categories'));
    }

    public function programs(Request $request)
    {
        $news_categories = Category::all();
        return view('frontend.pages.programs', compact('news_categories'));
    }

    public function staff(Request $request)
    {
        $news_categories = Category::all();
        return view('frontend.pages.staff', compact('news_categories'));
    }

    public function live(Request $request)
    {
        $news_categories = Category::all();
        return view('frontend.pages.live', compact('news_categories'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'searchnews' => 'required|string'
        ]);

        $news_categories = Category::all();

        $search = $request->searchnews;

        $newssearch = News::with('category')->where('title', 'like', '%' . $search . '%')->whereHas('category')->where('status', 1)->get();

        return view('frontend.pages.search', compact('newssearch', 'news_categories'));
    }

    public function Home()
    {
        $topnewslist = News::latest()->where('status', 1)->take(9)->get();
        $news_categories = Category::where('status', 1)->get();

        $newscategory_one = News::latest()->where('status', 1)->skip(9)->take(3)->get();
        $newscategory_two = News::latest()->where('status', 1)->skip(12)->take(2)->get();

        $newscategory_three = News::latest()->where('status', 1)->skip(14)->take(4)->get();

        // $newscategory_four = News::latest()->where('status', 1)->skip(19)->take(4)->get();

        return view('frontend.pages.ajax-home', compact(
            'topnewslist',
            'news_categories',
            'newscategory_one',
            'newscategory_two',
            'newscategory_three'
            // 'newscategory_four'
        ));
    }

    public function GetVideos()
    {
        $videos = Video::orderBy('publishTime', 'desc')->paginate(16);
        $news_categories = Category::where('status', 1)->get();

        return view('frontend.pages.videos', compact('videos', 'news_categories'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{

    public function index()
    {
        $newslist = News::latest()->with('category')->get();

        return view('backend.news.index', compact('newslist'));
    }

    public function create()
    {
        // $categories = Category::latest()->select('id', 'name')->where('status', 1)->orderBy('id', 'desc')->get();
        $categories = Category::where('status', 1)->select('id', 'name')->orderBy('id', 'asc')->get();

        return view('backend.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|unique:news|max:255',
            'details'       => 'required',
            'language'      => 'required',
            'category_id'   => 'required',
            'imagename'     => 'required'
        ]);

        if (isset($request->status)) {
            $status = true;
        } else {
            $status = false;
        }

        if (isset($request->featured)) {
            $featured = true;
        } else {
            $featured = false;
        }

        $image_name = 'news-' . time() . uniqid() . '.jpg';

        $image_data = $request->file('image');
        $this->ImageResizeSave($image_data, $image_name, 200, 120, 'sm-');
        $this->ImageResizeSave($image_data, $image_name, 360, 205, 'md-');
        $this->ImageResizeSave($image_data, $image_name, 730, 410);

        News::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'details'       => $request->details,
            'category_id'   => $request->category_id,
            'image'         => $image_name,
            'language'      => $request->language,
            'status'        => $status,
            'featured'      => $featured,
            'author'        => $request->author
        ]);

        return redirect()->route('admin.news.create')->with(['message' => 'News created successfully!']);
    }

    public function edit(News $news)
    {
        $categories = Category::latest()->select('id', 'name')->where('status', 1)->get();
        $news       = News::findOrFail($news->id);

        return view('backend.news.edit', compact('categories', 'news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'         => 'required|max:255',
            'details'       => 'required',
            'language'      => 'required',
            'category_id'   => 'required',
        ]);

        if (isset($request->status)) {
            $status = true;
        } else {
            $status = false;
        }

        if (isset($request->featured)) {
            $featured = true;
        } else {
            $featured = false;
        }

        if ($request->hasFile('image')) {
            $image_name = 'news-' . time() . uniqid() . '.jpg';

            $this->DeleteImage($news->image);
            $image_data = $request->file('image');

            $this->ImageResizeSave($image_data, $image_name, 200, 120, 'sm-');
            $this->ImageResizeSave($image_data, $image_name, 360, 205, 'md-');
            $this->ImageResizeSave($image_data, $image_name, 730, 410);
        } else {
            $image_name = $news->image;

            $image = public_path('images/news/' . $image_name);

            $this->ImageResizeSave($image, $image_name, 200, 120, 'sm-');
            $this->ImageResizeSave($image, $image_name, 360, 205, 'md-');
            $this->ImageResizeSave($image, $image_name, 730, 410);
        }

        $news->update([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'details'       => $request->details,
            'category_id'   => $request->category_id,
            'image'         => $image_name,
            'language'      => $request->language,
            'status'        => $status,
            'featured'      => $featured,
            'author'        => $request->author
        ]);
        return redirect()->route('admin.news.index')->with(['message' => 'News updated successfully!']);
        // return redirect()->route('admin.news.index')->with(['message' => 'News updated successfully!']);
    }

    public function ImageResizeSave($image_data, $image_name, $width, $height, $size = null)
    {
        if ($size) {
            $image_name = $size . $image_name;
        }

        $img = Image::make($image_data)->encode('jpg');
        $img->sharpen(10);
        $img->fit($width, $height);
        $img->save(public_path('images/news/' . $image_name));
    }

    public function DeleteImage($image)
    {
        $lg = public_path('images/news/' . $image);
        $md = public_path('images/news/md-' . $image);
        $sm = public_path('images/news/sm-' . $image);

        $files = [$sm, $md, $lg];

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function UpdateVideos()
    {
        $content = file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UC402wvzcZMwNUWowYLSb2Sg&maxResults=3&key=AIzaSyBDnFfjlMHdxRbNSm4d4k_FAAoueXPhoIg');
        $video_list = json_decode($content);

        foreach ($video_list->items as $video) {
            $v_exist = Video::where('v_id', $video->id->videoId)->count();
            if ($v_exist === 0) {
                Video::create([
                    'title'         => $video->snippet->title,
                    'v_id'          => $video->id->videoId,
                    'publishTime'   => date('Y-m-d h:i:s', strtotime($video->snippet->publishedAt))
                ]);
            }
        }

        return redirect()->back()->with(['message' => 'Videos updated successfully!']);
    }

    public function destroy(News $news)
    {
        $news = News::findOrFail($news->id);

        $this->DeleteImage($news->image);

        $news->delete();

        return back()->with(['message' => 'News deleted successfully!']);
    }
}

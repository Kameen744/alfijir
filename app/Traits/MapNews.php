<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait MapNews {
    public static function News($news)
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

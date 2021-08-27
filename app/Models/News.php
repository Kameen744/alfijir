<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'slug',
    'details', 'image', 'language',
    'category_id', 'status', 'featured',
    'view_count', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function SanitizeDetails()
    {
        return strip_tags($this->details, '<p><b><a><img>');
    }

    public function SanitizeDetailsHome()
    {
        return strip_tags($this->details);
    }
}

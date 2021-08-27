<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'status'];


    public function newslist()
    {
        return $this->hasMany(News::class);
    }
}

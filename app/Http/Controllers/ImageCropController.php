<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageCropController extends Controller
{
    public function index()
    {
        return view('image_crop');
    }

    public function upload(Request $request)
    {

        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'news-' . time() . uniqid() . '.png';
            $upload_path = public_path('images/news/' . $image_name);
            file_put_contents($upload_path, $data);
            return response()->json(['path' => 'images/news/' . $image_name]);
        }
    }
}

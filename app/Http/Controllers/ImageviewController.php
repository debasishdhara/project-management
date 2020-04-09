<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageviewController extends Controller
{
    public function displayImage($filename){
        $path = storage_public($filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

     /**
     * Show user avatar
     *
     * @param $id
     * @param $image
     * @return string
     */
    public function company_profile($company_image, $image)
    {
        return Image::make(storage_path() . '/app/' . $company_image . '/' . $image)->response();
    }
}

<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function fetch($type,$id){

        //return asset('images/'.$type.'/'.$id);
        //return Storage::get('public/images/'.$type.'/'.$id);

        // if (!File::exists($path)) {
        //     abort(404);
        // }
        
        // $file = File::get($path);
        // $type = File::mimeType($path);
        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);
        // return $response;
        return Storage::download('public/images/'.$type.'/'.$id);
        // return response(file_get_contents($path),200,array(
        //     'Content-type'=>'image/jpeg'));
    }
}

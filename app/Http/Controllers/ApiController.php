<?php
 
namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\Image as UserImage;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getImages()
    {
        $images = UserImage::get();
        
        return response()->json([
            'success' => 1,
            'images' => $images
        ]);
    }
    
    public function getImage(Request $request)
    {
        $image = UserImage::find($request->id);
        
        if($image) {
            return response()->json([
                'success' => 1,
                'image' => $image
            ]);
        }

    }
}

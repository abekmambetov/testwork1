<?php
 
namespace App\Http\Controllers;
 
use App\Models\Image as UserImage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;

class HomeController extends Controller
{

    public function index()
    {
        return view('upload-form');
    }
    
    public function showImages(Request $request)
    {
        
        $orderBy = 'filename';
        $sort = 'asc';
        
        if($request->orderBy) {
            if($request->orderBy == 'name')
                $orderBy = 'filename';
            if($request->orderBy == 'date')
                $orderBy = 'created_at';   
            $sort = $request->sort;
        }
        
        $images = UserImage::orderBy($orderBy, $sort)->get();
            
        return view('images-list', [
            'images' => $images
        ]);
    }
    
    private function createFilename($fileName, $iter = 1) {
        
        $fileNameNoExtension = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
         
        $modifyedFileName = $fileNameNoExtension . ' ' . '(' .  $iter . ')' . '.' . $extension;
        $issetFilename = UserImage::where('filename', $modifyedFileName)->get();
        
        if(count($issetFilename))
        {
            $modifyedFileName = $this->createFilename($fileName, $iter+1);
        }
        
        return $modifyedFileName;
        
    }
    
    public function saveImages(Request $request)
    {

        $input_data = $request->all();

        $validator = Validator::make(
            $input_data, [
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif'
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Неправильный формат файла',
            ]);
        }

        $files = $request->file('images');
         
        //transliterate
        if($request->hasFile('images'))
        {
            foreach ($files as $file) {
                $fileName = strtolower(transliterate($file->getClientOriginalName()));

                $issetFilename = UserImage::where('filename', $fileName)->get();
                
                if(count($issetFilename))
                {
                    $fileName = $this->createFilename($fileName);
                } 
                
                $file->storeAs('public', $fileName);
                          
                // Image resizing
                $img = Image::make($file->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('/app/public/thumb_' .$fileName));

                $image = UserImage::create(['filename' => $fileName]);
            }
        }

         
  
    }
    
    public function getFile(Request $request)
    {
        Storage::disk('local')->makeDirectory('tobedownload',$mode=0775); // zip store here
        $zip_file=storage_path('app/tobedownload/file.zip');
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = storage_path('app/public'); // path to your pdf files
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {

            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
                // extracting filename with substr/strlen
                $relativePath = substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        $headers = array('Content-Type'=>'application/octet-stream',);
        $zip_new_name = date("y-m-d-h-i-s").".zip";
        return response()->download($zip_file,$zip_new_name,$headers);
    }
}

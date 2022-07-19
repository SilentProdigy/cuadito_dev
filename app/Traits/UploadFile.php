<?php 
namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    private function uploadFile($target_dir, UploadedFile $file)
    {   
        try
        {
            // Storing a new file
            $path = Storage::disk('public')->put($target_dir, $file);

            return $path;
        }
        catch(Exception $e)
        {
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return;
    }
}
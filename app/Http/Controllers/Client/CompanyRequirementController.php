<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyRequirementController extends Controller
{
    public function store(Request $request, Company $company)
    {
        $target_dir = 'companies/requirements/' . $company->id;
        $path = $this->createFile($target_dir, $request->file('requirement'));
        
        $company->requirements()->attach(
            $request->input('requirement_id'),
            ['url' => $path]
        );

        return redirect()->back()->with('success', 'Requirement was successfully uploaded.');     
    }

    private function createFile($target_dir, UploadedFile $file)
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

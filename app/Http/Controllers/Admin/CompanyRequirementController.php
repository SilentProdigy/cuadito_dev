<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyRequirementController extends Controller
{
    public function download(Company $company, Requirement $requirement)
    {
        $target_file = $company->requirements->where('id', $requirement->id)->first();

        return Storage::disk('public')->download($target_file->file->url);
    }   

}

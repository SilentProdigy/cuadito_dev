<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download(Attachment $attachment)
    {
        // $target_file = $company->requirements->where('id', $requirement->id)->first();

        return Storage::disk('public')->download($attachment->url);
    }
}

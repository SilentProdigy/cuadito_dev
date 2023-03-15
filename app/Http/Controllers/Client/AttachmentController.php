<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\BiddingRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download(BiddingRequirement $biddingRequirement)
    {
        // $target_file = $company->requirements->where('id', $requirement->id)->first();

        return Storage::disk('public')->download($biddingRequirement->url);
    }
}

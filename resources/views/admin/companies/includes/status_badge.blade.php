@if($item->file->status == \App\Models\CompanyRequirement::APPROVED_STATUS)
    <span class='badge rounded-pill bg-success px-3 py-2'>APPROVED</span>
@elseif($item->file->status == \App\Models\CompanyRequirement::DISAPPROVED_STATUS)
    <span class='badge rounded-pill bg-danger px-3 py-2'>DISAPPROVED</span>
@else
    <span class='badge rounded-pill bg-dark px-3 py-2'>FOR APPROVAL</span>
@endif
    
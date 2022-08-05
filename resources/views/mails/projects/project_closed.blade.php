@component('mail::message')
# PROJECT CLOSED

<b>ID:</b> PROJ-{{ $project->id }}<br>
<b>Project:</b>{{ $project->title }} <br>
<b>Company:</b>{{ $project->company->name }}<br>
<b>Status:</b>{{ $project->status }}<br>
<b>Remarks:</b>
    Project  - #ID {{ $project->id }} posted by {{ $project->company->name }}, is officially closed & will not accept further proposals. <br>
 
@component('mail::button', ['url' => route('client.projects.show', $project)])
View Project
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
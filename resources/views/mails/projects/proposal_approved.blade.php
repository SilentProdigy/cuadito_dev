@component('mail::message')
# Congratulations!

<b>ID:</b> PROJ-{{ $project->id }}<br>
<b>Project:</b>{{ $project->title }} <br>
<b>Company:</b>{{ $project->company->name }}<br>
<b>Status:</b>{{ $project->status }}<br>
<b>Remarks:</b><br>
Your Company's proposal for Project {{ $project->title }} was approved by the project host!<br>
To learn more you can click button below.<br>

@component('mail::button', ['url' => route('client.projects.show', $project)])
View Project
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
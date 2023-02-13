@component('mail::message')
# PROPOSAL SUBMISSION

<b>ID:</b> #{{ $proposal->id }}<br>
<b>Project:</b>{{ $proposal->project->title }} <br>
<b>Company:</b>{{ $proposal->company->name }}<br>
<b>Remarks:</b><br>
Company {{ $proposal->company->name }} submitted a proposal to your posted project.<br>

@component('mail::button', ['url' => route('client.proposals.show', $proposal)])
View Proposal
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
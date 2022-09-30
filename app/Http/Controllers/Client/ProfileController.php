<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function show(Client $client)
    {
        return view('client.profile.show')->with(compact('client'));
    }

    public function edit(Client $client)
    {
        $civil_status_options = Client::CIVIL_STATUS_OPTIONS;
        return view('client.profile.edit')->with(compact('client', 'civil_status_options'));
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return redirect(route('client.profile.show', $client));
    }
}

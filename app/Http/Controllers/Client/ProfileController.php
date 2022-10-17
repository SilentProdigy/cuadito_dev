<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordFormRequest;
use App\Models\Client;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    use UploadFile;

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
        try {
            $data = $request->except('profile_pic');
            
            $target_dir = "clients/profile_pics/" . $client->id;

            if($request->has('profile_pic')) {
                $path = $this->uploadFile($target_dir, $request->file('profile_pic'));
                $data['profile_pic'] = $path;
            }

            $client->update($data);
            return redirect(route('client.profile.show', $client));
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function editPassword(Client $client)
    {
        return view('client.profile.change-password')->with(compact('client'));
    }

    public function changePassword(ChangePasswordFormRequest $request, Client $client)
    {
        try 
        {
            $client->update([
                'password' => bcrypt($request->input('password'))
            ]);

            return redirect(route('client.profile.show', $client));
        }   
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}

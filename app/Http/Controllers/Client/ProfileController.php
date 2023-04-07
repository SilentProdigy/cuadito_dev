<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\ChangePasswordRequest;
use App\Http\Requests\Client\Profile\UpdateProfileRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Contact;
use App\Traits\UploadFile;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    use UploadFile;

    public function show(Client $client)
    {
        $payments = Payment::with(['subscription', 'subscription.subscription_type'])
                    ->where('client_id', auth('client')->user()->id);

        $company = Company::where('client_id', $client->id)->first();
        $contacts = auth('client')->user()->contacts;

        $data = [
            'projects_count' => auth('client')->user()->projects()->count(),
            'projects' => auth('client')->user()->projects,
        ];

        $payments = $payments->paginate();
        return view('client.profile.show')->with(compact('client', 'data', 'payments', 'company', 'contacts'));
    }

    public function edit(Client $client)
    {
        $civil_status_options = Client::CIVIL_STATUS_OPTIONS;
        return view('client.profile.edit')->with(compact('client', 'civil_status_options'));
    }

    public function update(UpdateProfileRequest $request, Client $client)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('profile_pic');
            
            $target_dir = "images/profile_pics";

            if($request->has('profile_pic')) 
            {
                $path = $this->uploadFile(
                            "clients/profile_pics/{$client->id}", 
                            $request->file('profile_pic')
                        );

                $data['profile_pic'] = $path;
            }

            $client->update($data);
            
            DB::commit();
            
            return redirect(route('client.profile.show', $client));
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::error("ACTION: PROFILE_UPDATE, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }

    public function editPassword(Client $client)
    {
        return view('client.profile.change-password')->with(compact('client'));
    }

    public function changePassword(ChangePasswordRequest $request, Client $client)
    {
        DB::beginTransaction();
        try 
        {
            if(!Hash::check($request->input('old_password'), $client->password))
            {
                return redirect()->back()->withErrors(['message' => 'Entered old password is incorrect!']);
            }

            $client->update([
                'password' => bcrypt($request->input('password'))
            ]);
            DB::commit();
            return redirect(route('client.profile.show', $client));
        }   
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::error("ACTION: CHANGE_PASSWORD, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user) 
    {
        return view('admin.profile.show')->with(compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('admin.profile.edit')->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try 
        {
            $user->update($request->all());
    
            return redirect(route('admin.profile.show', $user));
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function editPassword(User $user)
    {
        return view('admin.profile.change-password')->with(compact('user'));
    }

    public function changePassword(ChangePasswordFormRequest $request, User $user)
    {
        try 
        {
            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);

            return redirect(route('admin.profile.show', $user));
        }   
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}

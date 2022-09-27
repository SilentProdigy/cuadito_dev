<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordFormRequest;
use App\Http\Requests\Admin\CreateUserFormRequest;
use App\Http\Requests\Admin\UpdateUserFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth.role.ensure_is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $roles = User::ROLES;

        return view('admin.users.index')->with(compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserFormRequest $request)
    {
        try 
        {
            $data = $request->all();
            $data['password'] = bcrypt($request->input('password'));

            User::create($data);
            return redirect()->route('admin.users.index')->with('success', 'User was successfully created.');  
        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserFormRequest $request, User $user)
    {
        try 
        {
            // TODO: Extract this to a class or a trait
            $user->update($request->all());
            return redirect()->route('admin.users.index')->with('success', 'User was successfully updated.');  
        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }

    public function setStatus(Request $request, User $user) 
    {
        try 
        {
            // TODO: Extract this to a class or a trait
            $user->update($request->all());
            return redirect()->route('admin.users.index')->with('success', 'User status was successfully updated.');  
        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }

    public function changePassword(ChangePasswordFormRequest $request, User $user) 
    {   
        try 
        {
            // TODO: Extract this to a class or a trait
            $user->update(['password' => bcrypt($request->input('password'))]);
            return redirect()->route('admin.users.index')->with('success', 'Password was successfully updated.');  
        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try 
        {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User was successfully deleted.');  
        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }
}

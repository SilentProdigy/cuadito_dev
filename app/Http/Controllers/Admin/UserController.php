<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordFormRequest;
use App\Http\Requests\Admin\CreateUserFormRequest;
use App\Http\Requests\Admin\UpdateUserFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $users = User::query()->when(request('search'), function($query) {
                    $query->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('role', 'LIKE', '%' . request('search') . '%');
                })
                ->where('id', '!=', auth()->user()->id)
                ->paginate(User::ITEMS_PER_PAGE);

        // $users = User::all();
        // return $users;
        
        $roles = User::ROLES;

        return view('admin.users.index')->with(compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserFormRequest $request)
    {
        DB::beginTransaction();
        try 
        {
            $data = $request->all();
            $data['password'] = bcrypt($request->input('password'));

            User::create($data);
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User was successfully created.');  
        }
        catch(\Exception $e) 
        {
            DB::rollBack();
            Log::error("ACTION: ADMIN_CREATE_USER, ERROR:" . $e->getMessage());   
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
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
        DB::beginTransaction();
        try 
        {
            // TODO: Extract this to a class or a trait
            $user->update($request->all());
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User was successfully updated.');  
        }
        catch(\Exception $e) 
        {
            DB::rollBack();
            Log::error("ACTION: ADMIN_UPDATE_USER, ERROR:" . $e->getMessage());   
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function setStatus(Request $request, User $user) 
    {
        DB::beginTransaction();
        try 
        {
            // TODO: Extract this to a class or a trait
            $user->update($request->all());
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User status was successfully updated.');  
        }
        catch(\Exception $e) 
        {
            DB::rollBack();
            Log::error("ACTION: ADMIN_SET_STATUS_USER, ERROR:" . $e->getMessage());   
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function changePassword(ChangePasswordFormRequest $request, User $user) 
    {   
        DB::beginTransaction();
        try 
        {
            // TODO: Extract this to a class or a trait
            $user->update(['password' => bcrypt($request->input('password'))]);
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Password was successfully updated.');  
        }
        catch(\Exception $e) 
        {
            DB::rollBack();
            Log::error("ACTION: ADMIN_SET_STATUS_USER, ERROR:" . $e->getMessage());   
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
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
        DB::beginTransaction();
        try 
        {
            $user->delete();
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User was successfully deleted.');  
        }
        catch(\Exception $e) 
        {
            DB::rollBack();
            Log::error("ACTION: ADMIN_DELETE_USER, ERROR:" . $e->getMessage());   
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);    
        }
    }
}

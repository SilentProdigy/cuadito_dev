<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role.ensure_is_admin');
    }
    
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.categories.index')->with(compact('categories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        DB::beginTransaction();
        try 
        {
            Category::create($request->all());
            DB::commit();
            return redirect()->route('admin.categories.index')->with('success', 'Category was successfully added.');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_CREATE_CATEGORY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try 
        {
            $category->update($request->all());
            DB::commit();
            return redirect()->route('admin.categories.index')->with('success', 'Category was successfully updated.');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_UPDATE_CATEGORY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try
        {
            $category->delete();
            DB::commit();
            return redirect()->route('admin.categories.index')->with('success', 'Category was successfully deleted.');  
        }
        catch(\Exception $e)
        {
            Log::error("ACTION: ADMIN_DESTROY_CATEGORY, ERROR:" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors([
                'Operation Failed!' => "Something went wrong; We are working on it."
            ]);
        }
    }
}

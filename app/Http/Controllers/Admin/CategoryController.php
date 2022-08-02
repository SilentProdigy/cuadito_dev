<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.categories.index')->with(compact('categories'));
    }

    public function destroy(Category $category)
    {
        try
        {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category was successfully deleted.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}

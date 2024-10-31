<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('adminPanel.categories.categories', ['categories' => $categories]);
    }

    public function getAllSubCategories()
    {
        $categories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->get();

        return view('adminPanel.categories.subCategories', ['subCategories' => $subCategories, 'categories' => $categories]);
    }

    public function getCategory(Category $category)
    {

        return response()->json([
            'error' => false,
            'data' => [
                'category' => $category,
            ],
        ]);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:categories,name'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::user()->id,
        ]);

        if ($category) {
            return redirect()->back()->with(['success' => 'Category Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'categoryId' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'unique:categories,name'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $category = Category::find($request->categoryId)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::user()->id,
        ]);

        if ($category) {
            return redirect()->back()->with(['success' => 'Category Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function fetchSubCategory(Category $category)
    {
        $subCategories = Category::where('parent_id', $category->id)->get();

        return response()->json([
            'error' => false,
            'data' => [
                'subCategories' => $subCategories,
            ],
        ]);
    }

    public function deleteCategory(Category $category)
    {
        try {
            if ($category->parent_id) {
                DB::transaction(function () use ($category) {
                    Product::where('subcategory_id', $category->id)->delete();
                    $category->delete();
                });
            } else {
                DB::transaction(function () use ($category) {
                    Product::where('category_id', $category->id)->delete();
                    Category::where('parent_id', $category->id)->delete();
                    $category->delete();
                });
            }

            return redirect()->back()->with(['success' => 'Category Deleted Successfully']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }

    }

    public function editSubCategory(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('adminPanel.categories.editSubCategory', compact('category', 'categories'));
    }

    public function updateSubCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:categories,name,'.$category->id],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        if ($category) {
            return redirect()->back()->with(['success' => 'Category Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
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
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $category = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
        if ($category) {
            return redirect()->back()->with(['error' => 'Category Already Exists']);
        }

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

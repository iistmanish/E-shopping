<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoriesPerPage = 10; // Change this as needed
    
        $query = Category::query();
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                ->orWhere('status', 'LIKE', "%$search%");
            });
        }
    
        $categories = $query->paginate($categoriesPerPage); // Change variable name to $categories
    
        return view('categories.index', compact('categories'));
    }
    
    // public function trashed_brands()
    // {
    //     $brands = Brand::onlyTrashed()->paginate(3);
    //     return view('brands.trash-index', compact('brands'));
    // }

    // public function restore($id)
    // {
    //     $brand = Brand::withTrashed()->findOrFail($id);
    //     if (!empty($brand)) {
    //         $brand->restore();
    //     }
    //     return redirect()->route('brands.index')->with('success', 'Brand restored successfully.');
    // }

    // public function deletePermanently($id)
    // {
    //     $brand = Brand::withTrashed()->findOrFail($id);
    //     if (!empty($brand)) {
    //         $brand->forceDelete();
    //     }
    //     return redirect()->route('brands.index')->with('success', 'Brand deleted permanently successfully.');
    // }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'parent_id' => 'required|string|max:255'
      
    ]);

    $newCategory = Category::create($data);

    return redirect()->route('categories.index')->with('success', 'Category created successfully');
}

    

    // public function edit(Category $category)
    // {
    //     return view('categories.edit', compact('category'));
    // }
    public function edit(Category $category)
{
    $categories = Category::all(); // Fetch all categories

    return view('categories.edit', [
        'category' => $category, // The category being edited
        'categories' => $categories, // All categories for dropdown
    ]);
}

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'parent_id' => 'required|string|max:255'
        ]);
    
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }




}

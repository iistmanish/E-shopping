<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;


use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $brands = Brand::all();
    //     $categories = Category::all();
    //     $searchQuery = $request->input('search');
    
    //     // Query products based on search query with pagination
    //     $products = Product::query()
    //         ->where('name', 'like', "%$searchQuery%") // Search product names
    //         ->orWhereHas('brand', function ($q) use ($searchQuery) {
    //             $q->where('name', 'like', "%$searchQuery%"); // Search brand names
    //         })
    //         ->orWhereHas('category', function ($q) use ($searchQuery) {
    //             $q->where('name', 'like', "%$searchQuery%"); // Search category names
    //         })
    //         ->paginate(8); // Paginate the results, adjust items per page as needed
    
    //     return view('shopping.index', compact('brands', 'categories', 'products'));
    // }
    public function index(Request $request)
{
    $brands = Brand::all();
    $categories = Category::all();
    $searchQuery = $request->input('search');
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');
    
    // Query products based on search query and price range with pagination
    $productsQuery = Product::query()
        ->where('name', 'like', "%$searchQuery%") // Search product names
        ->orWhereHas('brand', function ($q) use ($searchQuery) {
            $q->where('name', 'like', "%$searchQuery%"); // Search brand names
        })
        ->orWhereHas('category', function ($q) use ($searchQuery) {
            $q->where('name', 'like', "%$searchQuery%"); // Search category names
        });

    // Filter by minimum price if provided
    if ($minPrice) {
        $productsQuery->where('price', '>=', $minPrice);
    }

    // Filter by maximum price if provided
    if ($maxPrice) {
        $productsQuery->where('price', '<=', $maxPrice);
    }

    $products = $productsQuery->paginate(8); // Paginate the results, adjust items per page as needed

    return view('shopping.index', compact('brands', 'categories', 'products'));
}

    

    public function service()
    {
        return view('shopping.service');
    }
    public function aboutus()
    {
        return view('shopping.about');
    }
    public function filterByBrand(Request $request,$brand_id)
    {
         
        $categories = Category::all();
        $brands = Brand::all();
        
        // $brandID = $request->input('brand_id');
        // dd($brandID);
        $products = Product::where('brand_id', $brand_id)->paginate(8);
       
        return view('shopping.index', compact('products','brands','categories'));

    }


    public function filterByCategory(Request $request, $category_id)
    {
        $brands = Brand::all();
        $categories = Category::where('parent_id', 0)->get();

        // Fetch subcategories of the selected category
        $subcategories = Category::where('parent_id', $category_id)->pluck('id');
    
        // Fetch further subcategories based on the retrieved subcategories
        $furtherSubcategories = Category::whereIn('parent_id', $subcategories)->pluck('id');
    
        // Combine all relevant category IDs (including the parent)
        $allCategoryIds = $furtherSubcategories->merge($subcategories)->push($category_id)->toArray();
    
        // Fetch products associated with these subcategories or further subcategories
        $products = Product::whereHas('category', function ($query) use ($allCategoryIds) {
            $query->whereIn('id', $allCategoryIds);
        })->paginate(8);

        return view('shopping.index', compact('products', 'categories','brands'));
    }


    
    public function filterBySubcategory(Request $request, $subcategory_id)
    {
        $brands = Brand::all();
        $categories = Category::all();
        // $products = Product::where('subcategory_id', $subcategory_id)->get();
        $products = Product::whereHas('category', function ($query) use ($subcategory_id) {
            $query->where('parent_id', $subcategory_id);
        })->paginate(8);
        
        
        return view('shopping.index', compact('products', 'categories','brands'));
    }
    


    public function filterByFurtherSubcategory(Request $request, $further_subcategory_id)
    {
        $brands = Brand::all();
        $categories = Category::all();

        
        $products = Product::whereHas('category', function ($query) use ($further_subcategory_id) {
            $query->where('id', $further_subcategory_id); // Assuming the ID is stored in the Category table
        })->paginate(8);
        return view('shopping.index', compact('products', 'categories','brands'));
    }



    
    public function showChangePasswordForm()
    {
        return view('shopping.user-changepassword');
    }

    // Method to update the user's password
    public function updatePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the authenticated user
        $user = Auth::guard('student')->user();

        // Check if the current password matches the one in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match your password.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('shopping.login')->with('success', 'Password updated successfully!');
    }
}
  



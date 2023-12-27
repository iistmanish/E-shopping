<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $productsPerPage = 6; // Change this as needed

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%");
            });
        }

        $products = $query->paginate($productsPerPage); // Change variable name to $categories

        return view('products.index', compact('products'));
    }


    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.create', ['categories' => $categories, 'brands' => $brands]);
    }


    public function store(Request $request)
    {

        $product = new Product;
        $product->name = $request->input('name');
        $product->product_description = $request->input('product_description');
        $product->mrp = $request->input('mrp');
        $product->selling_price = $request->input('selling_price');
        // $product->product_image = $request->input('product_image');
        // $product->multiple_image = $request->input('multiple_image');

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // dd($image);
            $image->move(public_path('uploads'), $filename);
            $product->product_image = 'uploads/'.$filename;
        }

        // Handle multiple images upload
        if ($request->hasFile('multiple_image')) {
            foreach ($request->file('multiple_image') as $key => $image) {
                $filename = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $filename);
                $product->multiple_image = 'uploads/'.$filename;
            }
        }



        $isStock = $request->input('is_stock') === 'yes' ? 1 : 0;
        $product->is_stock = $isStock;


        $product->available_quantity = $request->input('available_quantity');
        $product->status = $request->input('status');
        $product->categories()->attach($request->input('categories'));
        $product->brands()->attach($request->input('brands'));

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }
    //     // Validate incoming request data
//         $data = $request->validate([
//             'name' => 'required',
//             'product_description' => 'required',
//             'mrp' => 'required',
//             'selling_price' => 'required',
//             'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//             'multile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//             'is_stock' => 'required|in:yes,no',
//             'available_quantity' => 'required|numeric',
//             'status' => 'required|in:active,disabled',
//             'category_id' => 'required|numeric',
//             'brand_id' => 'required|numeric',
//         ]);
//         $data['is_stock'] = ($data['is_stock'] === 'yes') ? 1 : 0;

    //     // Handle image upload if provided
//     if ($request->hasFile('product_image')) {
//         $imagePath = $request->file('product_image')->store('product_images', 'public');
//         $data['product_image'] = $imagePath;
//     }
//     if ($request->hasFile('multiple_image')) {
//         foreach ($request->file('multiple_image') as $key => $image) {
//            $imagePath = $image->store('product_images', 'public');
//            $data['multiple_image'][$key] = $imagePath;
//    }
// }

    //     $newProduct = Product::create($data);
//     return redirect()->route('products.index')->with('success', 'Product created successfully');
// }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'product_description' => 'required',
            'mrp' => 'required',
            'selling_price' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'multiple_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_stock' => 'required|in:yes,no',
            'available_quantity' => 'required|numeric',
            'status' => 'required|in:active,disabled',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
        ]);
        $data['is_stock'] = ($data['is_stock'] === 'yes') ? 1 : 0;
        // Handle image upload if provided
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $data['product_image'] = $imagePath;
        }
        if ($request->hasFile('multiple_image')) {
            foreach ($request->file('multiple_image') as $key => $image) {
                $imagePath = $image->store('product_images', 'public');
                $data['multiple_image'][$key] = $imagePath;
            }
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }


}






// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// // ProductController.php

// use App\Models\Product;

// class ProductController extends Controller
// {
//     public function index(Request $request)
//     {
//         $search = $request->input('search');
//         $productsPerPage = 5;

//         $query = Product::query();

//         // Add any additional conditions based on your search or filtering requirements
//         if ($search) {
//             $query->where(function ($q) use ($search) {
//                 $q->where('product_name', 'LIKE', "%$search%")
//                     ->orWhere('status', 'LIKE', "%$search%");
//             });
//         }

//         $products = $query->orderBy('id')->paginate($productsPerPage);

//         return view('product.index', compact('products'));


//     // Other methods...
// }



//     public function create()
//     {
//         return view('product.create');
//     }

//     public function store(Request $request)
// {
//     $data = $request->validate([
//         'product_name' => 'required',
//         'product_description' => 'required',
//         'mrp' => 'required',
//         'selling_price' => 'required',
//         'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Handle multiple images

//         'is_stock' => 'required|in:yes,no',
//         'available_quantity' => 'required|numeric',
//         'status' => 'required|in:active,disabled',
//         'category_id' => 'required|numeric',
//         'brand_id' => 'required|numeric',
//     ]);
//     $isStock = $request->input('is_stock') === 'yes' ? 1 : 0;

//     // Handle single image upload
//     if ($request->hasFile('product_image')) {
//         $imagePath = $request->file('product_image')->store('product_images', 'public');
//         $data['product_image'] = $imagePath;
//     }

//     // Handle multiple images upload
//     if ($request->hasFile('multiple_images')) {
//         foreach ($request->file('multiple_images') as $key => $image) {
//             $imagePath = $image->store('product_images', 'public');
//             $data['multiple_images'][$key] = $imagePath;
//         }
//     }

//     $newProduct = Product::create($data);
//     return redirect()->route('product.index')->with('success', 'Product created successfully');
// }

//     public function edit(Product $product)
//     {
//         return view('product-edit', compact('product'));
//     }

//     public function update(Request $request, Product $product)
//     {
//         $data = $request->validate([
//             'product_name' => 'required',
//             'product_description' => 'required',
//             'mrp' => 'required',
//             'selling_price' => 'required',
//             'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//             'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Handle multiple images

//             'is_stock' => 'required|in:yes,no',
//             'available_quantity' => 'required|numeric',
//             'status' => 'required|in:active,disabled',
//             'category_id' => 'required|numeric',
//             'brand_id' => 'required|numeric',
//         ]);

//         // Handle single image upload
//         if ($request->hasFile('product_image')) {
//             $imagePath = $request->file('product_image')->store('product_images', 'public');
//             $data['product_image'] = $imagePath;
//         }

//         // Handle multiple images upload
//         if ($request->hasFile('multiple_images')) {
//             foreach ($request->file('multiple_images') as $key => $image) {
//                 $imagePath = $image->store('product_images', 'public');
//                 $data['multiple_images'][$key] = $imagePath;
//             }
//         }

//         $product->update($data);
//         return redirect()->route('product.index')->with('success', 'Product updated successfully');
//     }

//     public function destroy(Product $product)
//     {
//         $product->delete();
//         return redirect()->route('product.index')->with('success', 'Product deleted successfully');
//     }
// }
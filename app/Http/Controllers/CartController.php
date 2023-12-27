<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
        $cart[$productId] = $cart[$productId] ?? 0;
        $cart[$productId]++;
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function updateCart(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
        
        // Handle quantity change
        $quantityChange = $request->input('quantity_change');
        $currentQuantity = $cart[$productId] ?? 0;

        if ($quantityChange === 'increment') {
            $cart[$productId] = $currentQuantity + 1;
        } elseif ($quantityChange === 'decrement' && $currentQuantity > 0) {
            $cart[$productId] = $currentQuantity - 1;
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }
    public function showCart()
    {
        $cart = session('cart', []);
    
        // Get only the product IDs that have a quantity greater than 0 in the cart
        $productIds = array_keys(array_filter($cart, function ($quantity) {
            return $quantity > 0;
        }));
    
        // Retrieve only the products that are in the cart
        $products = Product::whereIn('id', $productIds)->get();
    
        $totalPrice = 0;
    
        // Calculate the total price based on the products in the cart
        foreach ($products as $product) {
            $totalPrice += $product->mrp * $cart[$product->id];
        }
    
        return view('shopping.mycart', compact('cart', 'products', 'totalPrice'));
    }
    
    
    
    public function removeFromCart(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
    
        // Check if the product exists in the cart
        if (isset($cart[$productId])) {
            // Remove the product from the cart
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
            
            // Optionally, provide a success message
            return redirect()->back()->with('success', 'Item removed from cart');
        }
    
        // Optionally, provide an error message if the product was not found in the cart
        return redirect()->back()->with('error', 'Product not found in cart');
    }
    
    
    

  
}
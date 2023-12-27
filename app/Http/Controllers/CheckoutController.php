<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;


class CheckoutController extends Controller
{
    //
   
    public function showCheckout()
    {
        $cart = session('cart', []);
        $productQuantities = array_filter($cart, function ($quantity) {
            return $quantity > 0;
        });
    
        $productIds = array_keys($productQuantities);
        $selectedItems = Product::whereIn('id', $productIds)->get();
    
        // Associate product quantities with their details
        $selectedItemsWithQuantities = $selectedItems->map(function ($item) use ($productQuantities) {
            $item->quantity = $productQuantities[$item->id];
            return $item;
        });
    
        // Store the selected items in the session
        session(['selectedItemsWithQuantities' => $selectedItemsWithQuantities]);
    
        // Calculate total price
        $totalPrice = $selectedItemsWithQuantities->sum(function ($item) {
            return $item->mrp * $item->quantity;
        });
    
        return view('shopping.checkout', compact('selectedItemsWithQuantities', 'totalPrice'));
    }
    

    public function processCheckout(Request $request)
    {
        // Validation rules for shipping details
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_mode' => 'required|string',
        ]);
    
        if (Auth::guard('student')->check()) {
            $studentId = Auth::guard('student')->id();
        } else {
            // Handle the case where the student is not authenticated
            return redirect()->route('shopping.login')->with('error', 'You need to log in to place an order.');
        }
        // $paymentMode = $request->input('payment_mode');
        // $status = $request->input('status');
    
        // Calculate the total price based on the items in the cart
        $selectedItemsWithQuantities = $request->session()->get('selectedItemsWithQuantities');
    
        // Ensure $selectedItemsWithQuantities is a collection
        if (!$selectedItemsWithQuantities instanceof \Illuminate\Support\Collection) {
            // Handle the case where $selectedItemsWithQuantities is not a collection
            // You can redirect back with an error message or handle it as needed.
        }
    
        $totalPrice = $this->calculateTotalPrice(collect($selectedItemsWithQuantities));
        $productNames = $selectedItemsWithQuantities->pluck('name')->toArray();
        $quantities = $selectedItemsWithQuantities->pluck('quantity')->toArray();
    
        // Create a new order with student_id, payment_mode, and status
        $order = Order::create([
            'student_id' => $studentId,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'total' => $totalPrice,
            'product_name' => json_encode($productNames),
            'quantities' => json_encode($quantities),
            'payment_mode' => $request->input('payment_mode'),
            // 'status' => $status,
        ]);
         // Inside your processCheckout function

          if ($request->input('payment_mode') === 'stripe') {
    try {
        // Set your Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));
        // Create a charge
        $charge = Charge::create([
            'amount' => $totalPrice * 100, // Amount in cents
            'currency' => 'usd', // Change to your currency code
            'source' => $request->stripeToken, // Token from frontend
            'description' => 'Payment success',
        ]);

        // Update the order with payment success information
        $order->update(['payment_status' => 'success']);

    } catch (\Exception $e) {
        // Handle Stripe payment error
        return redirect()
            ->back()
            ->withErrors(['stripe_error' => $e->getMessage()]);
    }
}

        // Clear the cart or perform any other necessary cleanup
        $request->session()->forget('cart');
    
        // Redirect to the processed order page
        return redirect()->route('shopping.index', ['orderId' => $order->id])->with('success', 'Order placed successfully!');
    }
    

   

  
    public function calculateTotalPrice($selectedItemsWithQuantities)
    {
    // Sum the product of quantity and mrp for each selected item
    $totalPrice = $selectedItemsWithQuantities->sum(function ($item) {
        return $item->mrp * $item->quantity;
    });

    return $totalPrice;
}

}


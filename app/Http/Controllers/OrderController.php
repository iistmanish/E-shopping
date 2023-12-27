<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderindex(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::all();
        

        $orders = Order::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function orderdetails(Request $request)
    {
    $orders = Order::all();

    return view('orders.details', compact('orders'));
    }


        // $orders = Order::findOrFail($orderId);
    // Store a newly created order in storage
   

    public function orderview($orderId)
{
    // $studentId = Auth::guard('student')->id();

    // $orders = Order::where('student_id', $studentId)
    //               ->where('id', $orderId)
    //               ->with('products');
                   // Retrieve a single order by ID or throw a 404 if not found
    $orders = Order::findOrFail($orderId);
    return view('orders.view', compact('orders'));
}

    

    
    
    

  
}

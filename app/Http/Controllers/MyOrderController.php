<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

use App\Models\Student;

class MyOrderController extends Controller
{
    // public function myorder()
    // {
    //     // Get the authenticated student
    //     // $user = Auth::guard('student')->user();
    
    //     // // Load the orders relationship with product names, total, quantities, name, and address
    //     // $user->load(['orders' => function ($query) {
    //     //     $query->select('id', 'name',
    //     //     'address',
    //     //     'email',
    //     //     'phone',
    //     //     'total',
    //     //     'product_name',
    //     //     'quantities',)
    //     //         ->latest(); // Order by the latest orders first
    //     // }]);
    
    //     // // Log the loaded orders (check your Laravel logs for this information)
    //     // \Log::info('Loaded Orders: ' . $user->orders);
    //     $studentId = Auth::guard('student')->id(); // Get the logged-in student's ID
    //     $orders = Order::where('student_id', $studentId)->get();
    
    //     return view('shopping.myorder', compact('orders'));
      
    // }

    public function index()
    {
        // Get the authenticated student
        $user = Auth::guard('student')->user();
    
        // Load the orders relationship with product names, total, quantities, name, and address
        $user->load(['orders' => function ($query) {
            $query->select('id', 'product_name', 'total', 'quantities', 'name', 'address','phone' ,'student_id','created_at','payment_mode',)
                ->latest(); // Order by the latest orders first
        }]);
    
        // Log the loaded orders (check your Laravel logs for this information)
        \Log::info('Loaded Orders: ' . $user->orders);
    
        // Pass the data to the view
        return view('shopping.myorder', compact('user'));
    }
    
  
 public function invoice($orderId)
{
    // Fetch order details along with associated student information
    $orders = Order::with('student')
        ->select('id', 'student_id', 'product_name', 'total', 'quantities', 'name', 'address', 'phone', 'created_at', 'payment_mode')
        ->findOrFail($orderId);
  
        if ($orders) {
            $studentId = $orders->student_id;
            $students = Student::find($studentId);
    
            return view('shopping.invoice', compact('orders','students'));
        } else {
            // Handle the case where no order with that ID is found
            // You might want to redirect or display an error message
     
    return view('shopping.invoice', compact('orders'));
      }

   }
   
}

//     public function view(){
//         $studentId = Auth::guard('student')->id(); // Get the logged-in student's ID
//         $orders = Order::where('student_id', $studentId)->get();
    
//         return view('shopping.view', compact('orders'));
//     }
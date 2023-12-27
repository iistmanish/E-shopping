<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Student;
use App\Models\Wishlist;
use App\Models\SocialAccount;
use FFI\Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    // protected $guard = 'web'; 
    public function register()
    {
        return view('shopping.register');
    }

    
    public function postregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:students,email',
                    'password' => 'required|string|min:6',
                    'phone' => 'required|numeric|min:10|unique:students,phone',
                    'city' => 'required|string|max:255',
        ]);

        // Hash the password before saving to the database
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        // Store validated data into the database
        Student::create($data);

        // Redirect after successful registration
        return redirect()->route('shopping.login')->with('success', 'User registered successfully');
    }


   
    public function Wishlist()
    {
        
        // Check if the user is authenticated
        $user = Auth::guard('student')->user();
    
        if ($user) {
             $wishlistItems = $user->wishlist()->with('product')->get();
            
            // Update wishlist count in session
            $wishlistCount = $user->wishlist()->count();
            session(['wishlistCount' => $wishlistCount]);
    
            return view('shopping.wishlist', ['wishlistItems' => $wishlistItems]);
        }
    
        return redirect('shopping.login')->back()->with('error', 'Please log in to view your wishlist.');
    }
    

    
    
    public function addToWishlist(Request $request, Product $product)
{
    $user = Auth::guard('student')->user();

    if (!$user) {
        return redirect()->route('shopping.login')->with('error', 'Please log in to add to wishlist.');
    }

    // Check if the product already exists in the user's wishlist
    $existingWishlistItem = Wishlist::where('student_id', $user->id)
        ->where('product_id', $product->id)
        ->first();

    if ($existingWishlistItem) {
        return redirect()->back()->with('error', 'This product is already in your wishlist!');
    }

    // Product doesn't exist in the wishlist, add it
    $wishlistItem = new Wishlist();
    $wishlistItem->student_id = $user->id;
    $wishlistItem->product_id = $product->id;
    $wishlistItem->save();

    // Update wishlist count in session
    $wishlistCount = Wishlist::where('student_id', $user->id)->count();
    session(['wishlistCount' => $wishlistCount]);

    return redirect()->back()->with('success', 'Product added to wishlist!');
}

    
    
    public function removewishlist(Wishlist $wishlist)
    {
        $wishlist->delete();
    
        // Recalculate wishlist count after item removal
        $user = Auth::guard('student')->user();
        if ($user) {
            $wishlistCount = Wishlist::where('student_id', $user->id)->count();
            session(['wishlistCount' => $wishlistCount]);
        }
    
        return redirect()->back()->with('success', 'Item removed from wishlist!');
    }
    
    
    
    public function logout()
    {
        Session::flush();
        Auth::guard('student')->logout();
        return redirect()->route('shopping.index')->with('success', 'Log out successfully');
    }
    

    public function student()
    {
        // Retrieve the authenticated user
        $authenticatedUser = Auth::user();

        // Your other logic...
    }

    public function signin()
    {
        return view('shopping.login');
    }

  
public function userloginPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('student')->attempt($credentials)) {
        // Successful login for students
        return redirect()->route('shopping.index')->with('success', 'Login successful');
    } else {
        // Failed login
        return redirect()->back()->with('error', 'Invalid credentials')->withInput();
    }
}

public function Productshow(Product $product)
{
    // Retrieve the product details by its ID and pass it to the view
    // if (!Auth::guard('student')->check()) {
    //     // If the user is not logged in, redirect to the login page
    //     return redirect()->route('shopping.login')->with('error', 'Please log in to proceed');
    // }

    return view('shopping.productdetails', ['product' => $product]);
}


public function redirectToProvider()
{
    return Socialite::driver('google')->redirect();
}

// LoginController.php

public function handleProviderCallback()
{
    try {
        $user = Socialite::driver('google')->user();

        $existingUser = SocialAccount::where('provider_name', 'google')
            ->where('provider_id', $user->getId())
            ->first();

        if ($existingUser) {
            Auth::guard('student')->loginUsingId($existingUser->student_id);
            return redirect()->route('shopping.index')->with('success', 'Login successful');
        } else {
            $existingStudent = Student::where('email', $user->getEmail())->first();

            if ($existingStudent) {
                // Link the Google account to the existing user.
                SocialAccount::create([
                    'provider_name' =>'google',
                    'provider_id' => $user->getId(),
                    'student_id' => $existingStudent->id,
                ]);

                Auth::guard('student')->loginUsingId($existingStudent->id);
                return redirect()->route('shopping.index')->with('success', 'Login successful');
            } else {
                // Email doesn't exist, so create a new user.
                $newStudent = Student::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                ]);

                SocialAccount::create([
                    'provider_name' =>'google',
                    'provider_id' => $user->getId(),
                    'student_id' => $newStudent->id,
                ]);

                Auth::guard('student')->loginUsingId($newStudent->id);
                return redirect()->route('shopping.index')->with('success', 'Login successful');
            }
        }
    } catch (\Exception $e) {
        \Log::error('Socialite Exception: ' . $e->getMessage());
        return redirect()->route('shopping.login')->with('error', 'Error authenticating with Google: ' . $e->getMessage());
    }
}











// ... (other methods)


public function facebookprovider(){
    return Socialite::driver('facebook')->redirect();
  
}

public function handleFacebookCallback()

    {
       try {
           $user = Socialite::driver('facebook')->user();
           
           \Log::info('Facebook User Details: ' . print_r($user, true));
    
           $existingUser = SocialAccount::where('provider_name', 'facebook')
               ->where('provider_id', $user->getId())
               ->first();
    
           \Log::info('Existing User Details: ' . print_r($existingUser, true));
    
           if ($existingUser) {
               Auth::guard('student')->loginUsingId($existingUser->student_id);
               return redirect()->route('shopping.index')->with('success', 'Login successful');
           } else {
               $newStudent = Student::create([
                   'name' => $user->getName(),
                   'email' => $user->getEmail(),
               ]);
    
               SocialAccount::create([
                   'provider_name' =>'facebook',
                   'provider_id' => $user->getId(),
                   'student_id' => $newStudent->id,
               ]);
    
               Auth::guard('student')->loginUsingId($newStudent->id);
    
               return redirect()->route('shopping.index')->with('success', 'Login successful');
           }
       } catch (\Exception $e) {
           \Log::error('Socialite Exception: ' . $e->getMessage());
           return redirect()->route('shopping.login')->with('error', 'Error authenticating with Facebook: ' . $e->getMessage());
       }
    }


}



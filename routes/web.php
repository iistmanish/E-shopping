<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\ForgotPasswordController;
use Laravel\Socialite\Facades\Socialite;



use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'guest'], function () {
    Route::get('/shopping/register', [AuthController::class, 'register'])->name('register');
    Route::post('/shopping/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/shopping/login', [AuthController::class, 'login'])->name('login');
    Route::post('/shopping/login', [AuthController::class, 'loginPost'])->name('login.post');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/shopping/admin', [AuthController::class, 'index'])->name('admin');
    Route::delete('/shopping/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::get('/users', [UserController::class, 'index'])->name('students.index');
Route::get('/users/create', [UserController::class, 'create'])->name('students.create');
Route::post('/users', [UserController::class, 'store'])->name('students.store.post');
Route::get('/users/{student}/edit', [UserController::class, 'edit'])->name('students.edit');
Route::put('/users/{student}', [UserController::class, 'update'])->name('students.update');
Route::delete('/users/{student}', [UserController::class, 'destroy'])->name('students.destroy');

Route::get('/trashed-users', [UserController::class, 'trashed_students'])->name('students.trashed');
Route::get('/restore-users/{id}', [UserController::class, 'restore'])->name('students.restore');
Route::get('/delete-users-permanently/{id}', [UserController::class, 'deletePermanently'])->name('students.deletePermanently');
// Route::get('/students', [StudentController::class, 'index'])->name('students.search');



Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
// Route::get('/trashed-brands', [BrandController::class, 'trashed_brands'])->name('brands.trashed');
// Route::get('/restore-brands/{id}', [BrandController::class, 'restore'])->name('brands.restore');
// Route::get('/delete-brands-permanently/{id}', [BrandController::class, 'deletePermanently'])->name('brands.deletePermanently');
// Route::get('/students', [StudentController::class, 'index'])->name('students.search');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');



Route::get('/', [ShoppingController::class, 'index'])->name('shopping.index');
Route::get('/services', [ShoppingController::class, 'service'])->name('shopping.services');
Route::get('/about-us', [ShoppingController::class, 'aboutus'])->name('shopping.about');
Route::get('/filter/brands/{brand_id}', [ShoppingController::class, 'filterByBrand'])->name('filter.brands');
Route::get('/filter/categories/{category_id}', [ShoppingController::class, 'filterByCategory'])->name('filter.categories');
Route::get('/filter/subcategories/{category_id}', [ShoppingController::class, 'filterBySubcategory'])->name('filter.subcategories');
Route::get('/filter/further-subcategories/{category_id}', [ShoppingController::class, 'filterByFurtherSubcategory'])->name('filter.furthersubcategories');





    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/update-cart/{product}', [CartController::class, 'updateCart'])->name('updateCart');
// Route::get('/shopping/mycart', [CartController::class, 'showCart'])->name('shopping.mycart');



Route::middleware(['auth:student'])->group(function () {
    Route::get('/shopping/mycart', [CartController::class, 'showCart'])->name('shopping.mycart');
    Route::get('/shopping/checkout', [CheckoutController::class, 'showCheckout']) ->name('shopping.checkout');
    
});





Route::post('/process-checkout', [CheckoutController::class, 'processCheckout'])->name('process.checkout');

Route::delete('/cart/remove/{product_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');





// Registration Routes
Route::get('/shopping/user-register', [LoginController::class, 'register'])->name('shopping.register');
Route::post('/shopping/user-register', [LoginController::class, 'postregister'])->name('register.submit');

// Login Routes
Route::get('/shopping/user-login', [LoginController::class, 'signin'])->name('shopping.login');
Route::post('/shopping/user-login-post', [LoginController::class, 'userloginPost'])->name('user.login.post');
Route::get('/shopping/wishlist',[LoginController::class, 'Wishlist'])->name('user.wishlist');
Route::post('/wishlist/add/{product}',[LoginController::class,  'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{wishlist}',[LoginController::class, 'removewishlist'])->name('wishlist.remove');
Route::get('/products/{product}',[LoginController::class,'Productshow'])->name('product.details');
Route::get('/user/password/change', [ShoppingController::class, 'showChangePasswordForm'])->name('user.password.change');
Route::post('/user/password/update', [ShoppingController::class, 'updatePassword'])->name('user.password.update');



// Logout Route
Route::get('/shopping/logout', [LoginController::class, 'logout'])->name('shopping.logout');

//profile for user
Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('user.update');
Route::get('/myorder', [MyOrderController::class, 'index'])->name('user.myorder');
// Route::get('/myorder/view/{orderId}', [MyOrderController::class, 'view'])->name('user.myorder.view');
Route::get('myorder/invoice/{orderId}', [MyOrderController::class, 'invoice'])->name('user.invoice');
Route::get('/generate-pdf/{orderId}', [InvoiceController::class, 'generatePDF'])->name('invoice.pdf');






// Route to display orders and search functionality
Route::get('/orders', [OrderController::class, 'orderindex'])->name('orders.index');

Route::get('/orders-details', [OrderController::class, 'orderdetails'])->name('orders.details');
Route::get('/orders-details/view/{orderId}', [OrderController::class, 'orderview'])->name('orders.view');



// Route::get('/login/google', [LoginController::class, 'provider'])->name('google.login');
// Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/login/google', [LoginController::class, 'redirectToProvider'])->name('socialite.redirect');

Route::get('login/google/callback', [LoginController::class, 'handleProviderCallback'])->name('socialite.callback');


Route::get('/login/facebook', [LoginController::class, 'facebookprovider'])->name('facebook.login'); 
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback'])->name('login.facebook.callback');





Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


Route::get('/stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('/stripe/payment',[StripePaymentController::class, 'stripepost'])->name('stripe.post');

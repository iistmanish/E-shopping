
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlXuoGdDjZcND1oHO/nKq92r59gjj9ZtSHo8mqvP98/N0" crossorigin="anonymous">

  <style>
    body {
      padding-top: 56px;
      background-color: antiquewhite;
    }

    .navbar {
      /* background-color: #343a40; */
      background-color: #06272d;
      height: 70px;
      box-shadow: 0px 2px 5px -1px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #ffffff !important;
      font-weight: bold;
    }

    .navbar-toggler-icon {
      background-color: #ffffff;
    }

    .navbar-toggler {
      border-color: #ffffff;
    }

    .navbar-nav .nav-item:hover .nav-link {
      color: #17a2b8 !important;
    }

    .navbar-nav .nav-item.active .nav-link {
      color: #17a2b8 !important;
    }

    .navbar-nav .dropdown-menu {
      background-color: #06272d;
       
    }

    .navbar-nav .dropdown-item {
      color: #ffffff !important;
    }

    .navbar-nav .dropdown-item:hover {
      background-color: #17a2b8;
    }

    .dropdown-menu1 li {
      position: relative;
    }

    .dropdown-menu1 .dropdown-submenu {
      background-color: #06272d;
      display: none;
      position: absolute;
      left: 100%;
      top: -7px;
    }

    .dropdown-menu1 .dropdown-submenu-left {
      right: 100%;
      left: auto;
    }

    .dropdown-menu1>li:hover>.dropdown-submenu {
      display: block;
    }

    .one {
      gap: 22px;
    }

    .ten {
      height: 140px;
      width: 140px;
      border-radius: 10px;


    }

    .card {
      height: 480px;
      border-radius: 10px ;
    }
    .manish{
      background-color:#343a40; 
      color: white;
    }

    .navbar-brand {
      margin-right: 30px;
    }
    .quantity-input{
      display: flex;
      margin-top: 10px;
    }
    nav .w-5{
            display: none;
        }

    
  </style>
  <title>Shopping Mart</title>
</head>



<body>
  <div class="container">
    {{-- <form method="post" > --}}
      
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#"
          style="font-family: 'Roboto', sans-serif; font-size: 17px; color: #333; font-weight: bold; text-decoration: none;">Shopping-Mart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-sm-2"></div>
        <div class="col-sm-9" >
          <div class="collapse navbar-collapse" id="navbarNav">
            
            <ul class="navbar-nav ml-auto one  ">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('shopping.index') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('shopping.services') }}">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('shopping.about') }}">About us</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBrand" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Brands
                </a>
            
                <div class="dropdown-menu" aria-labelledby="navbarDropdownBrand">
                 @if (!empty($brands))
                        <ul class="dropdown-menu1" aria-labelledby="dropdownMenuButton">
                            @foreach($brands as $brand)
                                <li>
                                    <a class="dropdown-item" href="{{route('filter.brands',['brand_id' => $brand->id])}}">
                                    {{-- {{route('filter.products', $brand->id)}}"> --}}
                                        {{ $brand->name }}
                                        <!-- Access other columns as needed -->
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No brands available.</p>
                    @endif
                </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategory" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
              </a> 



  <div class="dropdown-menu" aria-labelledby="navbarDropdownCategory">
    @if(!empty($categories))
    {{-- @if($categories && $categories->isNotEmpty()) --}}
          <ul class="dropdown-menu1" aria-labelledby="dropdownMenuButton">
            @foreach($categories->where('parent_id', 0) as $category)
                  <li>
                    
                      <a class="dropdown-item" href="{{ route('filter.categories', ['category_id' => $category->id]) }}">
                          {{ $category->name }}
                      </a>
                      @if(!empty($category->subcategories))
                          <ul class="dropdown-menu1 dropdown-submenu">
                              @foreach($category->subcategories as $subcategory)
                                  <li>
                                      <a class="dropdown-item" href="{{ route('filter.subcategories', ['category_id' => $subcategory->id]) }}">
                                          {{ $subcategory->name }}
                                      </a>

                                      @if(!empty($subcategory->furtherSubcategories))
                                          <ul class="dropdown-menu1 dropdown-submenu">
                                              @foreach($subcategory->furtherSubcategories as $furtherSubcategory)
                                                  <li>
                                                      <a class="dropdown-item" href="{{ route('filter.furthersubcategories', ['category_id' => $furtherSubcategory->id]) }}">
                                                          {{ $furtherSubcategory->name }}
                                                      </a>
                                                  </li>
                                              @endforeach
                                          </ul>
                                      @else
                                          <p>No further subcategories available.</p>
                                      @endif
                                  </li>
                              @endforeach
                          </ul>
                      @else
                          <p>No subcategories available.</p>
                      @endif
                  </li>
              @endforeach
          </ul>
      @else
          <p>No categories available.</p>
      @endif
  </div>
      </li>
          </ul> 

      
        
            

            
            


        
            
            {{-- <a class="navbar-brand" href="{{route('shopping.mycart')}}">
              <i class="fas fa-shopping-cart"></i>
              
              <span id="cartItemCount">Cart
                {{ array_sum(session('cart',[])) }}
              </span>
            </a> --}}
            
            

             <!-- End Shopping Cart Icon -->

       
             <div class="collapse navbar-collapse" id="navbarNav">
              <form class="form-inline ml-auto" method="get" action="{{ route('shopping.index') }}">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
             </div>
       

             
             <div class="collapse navbar-collapse" id="navbarNav">
             
              <ul class="navbar-nav ml-auto">
                <a class="navbar-brand" href="{{ Auth::guard('student')->check() ? route('shopping.mycart') : route('shopping.login') }}">
                  <i class="fas fa-shopping-cart"></i>
                  <span id="cartItemCount">Cart {{ array_sum(session('cart', [])) }}</span>
              </a>
                  <li class="nav-item dropdown">
                      <div class="dropdown">
                          @if(Auth::guard('student')->check())
                              <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  {{ Auth::guard('student')->user()->name }}
                              </a>
                              <!-- Dropdown menu items for authenticated users -->
                              <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">View Profile</a>
                                <a class="dropdown-item" href="{{ route('user.myorder') }}">My Order</a>
                                <a class="dropdown-item" href="{{ route('user.wishlist') }}">
                                  Wishlist ({{ session('wishlistCount', 0) }})
                              </a>
                                <a class="dropdown-item" href="{{ route('shopping.logout') }}">Log out</a>
                            </div>
                          @else
                              <!-- Display different content or login button for non-authenticated users -->
                              <a class="btn btn-warning" href="{{ route('shopping.login') }}">Login</a>
                              <a class="btn btn-primary" href="{{ route('shopping.register') }}">Sign-up</a>
                          @endif
                      </div>
                  </li>
              </ul>
             </div>
          
          

          </div>
        </div>
      </nav>
      
    {{-- </form> --}}
  </div>




{{-- {{dd($products)}} --}}

<div class="container mt-5">
  <div class="row">
      @foreach($products as $product)
      <div class="col-md-3 mb-3">
          <div class="card">
            <a href="{{ route('product.details', ['product' => $product->id]) }}">
              <img src="{{ asset($product->product_image) }}" class="card-img-top" alt="{{ $product->name }}">
          </a>
              <div class="card-body">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text">{{ $product->product_description }}</p>
                  <p class="card-text">MRP: ${{ $product->mrp }}</p>

                  @if(session('cart.' . $product->id, 0) == 0)
    <form method="post" action="{{ route('addToCart', ['product' => $product->id]) }}">
        @csrf
        <button class="btn btn-info mb-2" type="submit">Add to Cart</button>
    </form>
   @else
    <form method="post" action="{{ route('updateCart', ['product' => $product->id]) }}">
        @csrf
        <div class="quantity-input mb-2">
            <button type="submit" name="quantity_change" value="decrement">-</button>
            <input type="text" name="quantity" value="{{ session('cart.' . $product->id, 0) }}" readonly>
            <button type="submit" name="quantity_change" value="increment">+</button>
        </div>
    </form>
@endif

{{-- <form id="wishlistForm" method="post" action="{{ route('wishlist.add', ['product' => $product->id]) }}">
  @csrf
  <button type="submit" class="btn btn-outline-danger wishlistButton">
      <i class="fas fa-heart"></i> Add to Wishlist
  </button>
</form> --}}

    <form id="wishlistForm_{{ $product->id }}" class="wishlistForm" data-product-id="{{ $product->id }}" method="post" action="{{ route('wishlist.add', ['product' => $product->id]) }}">
        @csrf
        <button type="submit" onclick="addToWishlist(event, {{ $product->id }})">
            <i class="fas fa-heart"></i>
        </button>
    </form>




              </div>
          </div>
      </div>
      @endforeach
  </div>
</div>
<div >
  {{ $products->links('pagination::bootstrap-5') }}
</div>


<script>
function addToWishlist(event, productId) {
    event.preventDefault(); // Prevents the default form submission
    
    let form = document.getElementById(`wishlistForm_${productId}`);
    let button = form.querySelector('button');

    // Simulating form submission via AJAX
    fetch(form.action, {
        method: form.method,
        body: new FormData(form)
    })
    .then(response => {
        if (response.ok) {
            button.classList.remove('btn-outline-danger');
            button.classList.add('btn-danger');
            button.innerHTML = '<i class="fas fa-heart"></i>';
            button.setAttribute('disabled', true); // Disable the button after adding to wishlist
        } else {
            // Handle any errors or failed submission
            console.error('Wishlist addition failed.');
        }
    })
    .catch(error => {
        console.error('Error occurred:', error);
    });
}

  
  </script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="manish">
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h4>About Us</h4>
          <p>Shopping-Mart is a leading online retailer...</p>
        </div>
        <div class="col-md-4">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="{{route('shopping.index')}}">Home</a></li>
            <li><a href="{{route('shopping.index')}}">Shop</a></li>
            <li><a href="{{route('shopping.index')}}">Brands</a></li>
            <li><a href="{{route('shopping.index')}}">Categories</a></li>
            <li><a href="{{route('shopping.index')}}">Contact Us</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h4>Contact Information</h4>
          <p>53 New Jagdish Nagar Near Super Corriodr,Indore, India</p>
          <p>Email: shopping-mart@company.com</p>
          <p>Phone: +91 6263222401</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <p class="text-center">&copy; 2008 Shopping-Mart. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  </div>
</body>

</html>
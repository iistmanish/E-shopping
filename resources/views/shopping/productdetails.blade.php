
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <style>
        /* Add your custom styles here */
        /* Example: */
        .product-image {
            max-width: 100%;
            height: auto;
        }
        /* Other CSS classes for styling */
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($product->product_image) }}" class="product-image" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">{{ $product->product_description }}</p>
                <p>MRP: Rs{{ $product->mrp }}</p>
                <p>Selling Price: Rs{{ $product->selling_price }}</p>
                {{-- <p>Dimensions: {{ $product->dimensions }}</p>
                <p>Weight: {{ $product->weight }}</p>
                <p>Available Colors: {{ $product->available_colors }}</p> --}}
                <label for="product-options">Select Size:</label>
                <select id="product-options">
        <option value="small">Small</option>
        <option value="medium">Medium</option>
        <option value="large">Large</option>
                 </select>
                <!-- Cart buttons -->
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
                        
                     @if(auth('student')->check())
                        <a href="{{ route('shopping.mycart') }}" class="btn btn-success">My Cart</a>
                    @else
                        <a href="{{ route('shopping.login') }}" class="btn btn-dark">Login to Proceed</a>
                    @endif
                    
                    </form>
                @endif
                <div class="ratings-section">
                    <h4>Customer Ratings</h4>
                    <!-- Display stars or numerical rating -->
                    <p>4.5 out of 5 stars</p>
                    <a href="#reviews-section">See Reviews</a>
                </div>
            </div>
        </div>
        
    </div>
    

<!-- Bootstrap JS and other scripts if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js" integrity="sha384-Zmp9feVn6aIqE+geE7Kk6qc5k1fUJ5pL9/eJA4LZbX1MzXxFOv1YaR4iN5DyI6be" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyUtFz/Nl7JqHRnU4tQbBovca1p2t7xj" crossorigin="anonymous"></script>

</body>
</html>

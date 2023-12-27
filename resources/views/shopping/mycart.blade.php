<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }s

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cart-item {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .product-details {
            flex-grow: 1;
            text-align: left;
        }

        .product-details img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 5px;
            object-fit: cover;
        }

        .product-details p {
            font-size: 16px;
            color: #333;
            margin: 5px 0;
        }

        .product-name {
            font-weight: bold;
            font-size: 18px;
            color: #007bff;
        }

        .product-description {
            color: #666;
        }

        .price-details {
            text-align: right;
            width: 100px;
        }

        .price-details p {
            font-size: 16px;
            color: #333;
            margin: 5px 0;
        }

        .total-price {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        a {
            display: block;
            text-align: center;
            padding: 10px;
            background-color:  #0dcaf0;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    .card-header{
        background-color: #0dcaf0
    }
   .quantity-input{
    display: flex;
    gap:2px;
    margin:5px 0px 5px 23px;
   }
   .quantity-input input{
    width:25px;
   }

    </style>
    
</head>
<body>

    <body>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">My Cart</h1>
                </div>
                <div class="card-body">
                    @if (!empty($cart) && count($products) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($products as $product)
                                    <div class="cart-item">
                                        <div class="product-details">
                                            <img src="{{ asset($product->product_image) }}" class="card-img-top" alt="{{ $product->name }}">
                                            <p class="product-name">{{ $product->name }}</p>
                                            <p class="product-description">{{ $product->product_description }}</p>
                                        </div>
                    
                                       
                    <div class="price-details">
                        <p>Quantity: {{ $cart[$product->id] }}</p>
                        <p>MRP: {{ $product->mrp }}</p>

                        <!-- Form to update cart quantity -->
                        <form action="{{ route('updateCart', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            <div class="quantity-input">
                                <button type="submit" name="quantity_change" value="decrement">-</button>
                                <input type="text" name="quantity" value="{{ $cart[$product->id] }}" readonly>
                                <button type="submit" name="quantity_change" value="increment">+</button>
                            </div>
                        </form>
                        
                        <!-- Form to remove item from cart -->
                        <form action="{{ route('cart.remove', ['product_id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                                    </div>
                                @endforeach
        
                                <p class="total-price">Total Price: {{ $totalPrice }}</p>
                                <a href="{{ route('shopping.index') }}" class="btn btn-primary mt-3">Back</a>
                            {{-- </div>
                            <div class="col-md-12 text-md-right"> --}}
                                <a href="{{ route('shopping.checkout') }}" class="btn btn-success mt-3 float-right">Proceed to Checkout</a>
                            </div>
                        </div>
                    @else
                        <!-- Empty Cart Message -->
                        <p>Your cart is empty.</p>
                        <a href="{{ route('shopping.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Bootstrap JS and any other scripts you might have -->
    </body>
    
    </html>

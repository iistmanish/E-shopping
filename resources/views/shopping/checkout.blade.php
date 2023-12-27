<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Add Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        / Your custom styles here /

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .checkout-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
        }

        .checkout-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .checkout-form input,
        .checkout-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .checkout-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirmation-message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #007bff;
        }
        h2 {
            color:black;
            margin-bottom: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif

        }

    </style>
</head>
<body>
    <div class="container checkout-container">
        @if (empty($selectedItemsWithQuantities))
            <p class="alert alert-warning">No items selected for checkout.</p>
        @else
            <h2>Selected Items</h2>
            @foreach ($selectedItemsWithQuantities as $item)
                <div class="checkout-item">
                    <p>{{ $item->name }} - Quantity: {{ $item->quantity }} - MRP: {{ $item->mrp }}</p>
                </div>
                <input type="hidden" name="product_name[]" value="{{ $item->name }}">
                <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
            @endforeach

            <p class="lead">Total Price: Rs {{ $totalPrice }} </p>
      

            <h2>Shipping Details</h2>
            <form action="{{ route('process.checkout') }}" method="post" class="checkout-form">
                @csrf
                
                
            
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                
            
                <div class="form-group">
                    <label for="payment_mode">Payment Mode:</label>
                    <select id="payment_mode" name="payment_mode" class="form-control" required>
                        <option value="cash_on_delivery">Cash On Delivery</option>
                        <option value="stripe">Credit Card (Stripe)</option>
                    </select>
                </div>

                <div id="stripe-container">
                    <div class="form-group">
                        <label for="card-element">Credit or debit card</label>
                        <div id="card-element"></div>
                    </div>
        
                    <!-- Used to display form errors -->
                    <div id="card-errors" role="alert"></div>
        
                    <!-- Additional hidden input for storing the Stripe token -->
                    <input type="hidden" name="stripeToken" id="stripeToken">
                </div>
        
                {{-- <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
        
            @if ($errors->has('stripe_error'))
                <div class="alert alert-danger">
                    {{ $errors->first('stripe_error') }}
                </div>
            @endif
        </div>
                 --}}
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        @endif

        {{-- @if (session('success'))
            <p class="confirmation-message alert alert-success">{{ session('success') }}</p>
        @endif --}}
    </div>
<!-- Include Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ $stripeKey }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const errorElement = document.getElementById('card-errors');
    const stripeTokenInput = document.getElementById('stripeToken');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        try {
            const { token, error } = await stripe.createToken(cardElement);

            if (error) {
                errorElement.textContent = error.message;
            } else {
                errorElement.textContent = '';
                stripeTokenInput.value = token.id;
                form.submit();
            }
        } catch (err) {
            console.error('Error:', err);
        }
    });
</script>

    <!-- Add Bootstrap JS and Popper.js scripts (optional) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
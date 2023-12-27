{{-- 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">My Orders</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th> User Name</th>
                                        <th>Payment Mode</th>
                                        <th>Order Date</th>
                                        {{-- <th>Status</th> --}}
                                        {{-- <th>Quantity</th>
                                        <th>Product Name</th>
                                        <th>Total price</th> --}}
                                        {{-- <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> --}}
                                     <!-- Assuming $orders is correctly passed from the backend -->
                                     {{-- @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->student->name }}</td>
                                            <td>{{ $order->payment_mode }}</td>
                                            <td>{{ $order->created_at }}</td> --}}
                                            {{-- <td>{{ $order->status }}</td> --}}
                                            {{-- <td>{{ $order->quantities }}</td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>{{ $order->total }}</td> --}}
                                            {{-- <td>
                                                <a  href="{{ route('user.myorder.view', ['orderId' => $order->id]) }}" class="btn btn-warning">View</a>
                                            </td>
                                        </tr>
                                    @endforeach  --}}
                                    <!-- Assuming $orders loop ends here -->
                                {{-- </tbody>
                            </table> --}}
                            <!-- Pagination assuming $orders paginated from backend -->
                             {{-- <div class="mt-4">
                                {{$orders->links()}}
                            </div>  --}}
                         {{-- </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>   --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>My Orders - {{ $user->name }} (ID: {{ $user->id }})</h2>
    @if($user->orders->isEmpty())
        <p>No orders found.</p>
    @else
        <ul>
            @foreach($user->orders as $order)
                <li>
                    Order ID: {{ $order->id }}<br>
                    Total: ${{ $order->total }}<br>
                    Product Names: {{ $order->product_names }}<br>
                    Quantities: {{ $order->quantities }}<br>
                    Name: {{ $order->name }}<br>
                    Address: {{ $order->address }}<br>
                    Order Date: {{ $order->created_at }}
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 20px;
            font-family: 'Verdana', Geneva, Tahoma, sans-serif;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        li p {
            margin: 0;
            font-size: 16px;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
        }

        .order-info,
        .shipping-info {
            flex: 1;
            margin-right: 20px;
        }

        .order-info h3,
        .shipping-info h3 {
            color: #007bff;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .order-info p,
        .shipping-info p {
            color: #555;
            font-size: 16px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
  
    <h2>My Orders </h2>
    @if($user->orders->isEmpty())
        <p>No orders found.</p>
    @else
        <ul>
            @foreach($user->orders as $order)
                <li>
                    <div class="order-details">
                        <div class="order-info">
                            <h3>Order ID: {{ $order->id }}</h3>
                            <p>Product Names: {{ $order->product_name }}</p>
                            <p>Quantities: {{ $order->quantities }}</p>
                            <p>Payment Mode: {{ $order->payment_mode }}</p>
                            <p>Total: ${{ number_format($order->total, 2) }}</p> 
                            <p>Order Date: {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            
                        </div>
                        <div class="shipping-info">
                            <h3>Shipping Information</h3>
                            {{-- <p>User Id: {{ $order->student_id }}</p> --}}
                            <p>Name: {{ $order->name }}</p>
                            <p>Address: {{ $order->address }}</p>
                            <p>Mobile No: {{ $order->phone }}</p>
                            <a  href="{{ route('user.invoice', ['orderId' => $order->id]) }}" class="btn btn-info">View Invoice</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
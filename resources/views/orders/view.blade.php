@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders CRUD</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 10px;
        }
        .container {
            max-width: 1200px;
            margin-right: 60px;
            padding-top: 10px;
        }
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        nav .w-5{
            display: none;
        }
        .text-md-end{
            margin-left: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Orders View</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-9 text-md-end"> 
                            <a class="btn btn-info btn-sm float-right"  href="{{ route('orders.details') }}">Back</a><br>
                        </div><br>

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Payment Mode</th>
                                    <th>Date and Time</th>
                                    <th>Total Price</th>
                                    <th> Invoice </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders)
                                    <tr>
                                        <td>{{ $orders->id }}</td>
                                        <td>{{ $orders->product_name }}</td>
                                        <td>{{ $orders->quantities }}</td>
                                        <td>{{ $orders->payment_mode }}</td> <!-- Adjust property name for quantity -->
                                        <td>{{ $orders->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ $orders->total }}</td>
                                        <td>
                                            <a href="{{ route('user.invoice', ['orderId' => $orders->id]) }}" class="btn btn-success">View Invoice</a>
                                        </td>
                                        
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6">No orders found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection

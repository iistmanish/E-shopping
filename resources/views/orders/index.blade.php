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
    
        /* .one{
            max-width: 400px;
        } */
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Orders table</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <form action="{{ route('orders.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                </form>
                            </div>
                        </div>

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email Id</th>
                                    <th>Phone no</th>
                                    <th>Quantity</th>
                                    <th>Product Name</th>
                                    <th>Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->quantities }}</td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->total }}</td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


@endsection


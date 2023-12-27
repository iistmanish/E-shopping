@extends('layouts.app')

@section('content')
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Details</title>
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
                        <h3><b>Orders Details</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <form action="{{ route('orders.details') }}" method="GET" class="form-inline">
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
                                    {{-- <th>User ID</th> --}}
                                    {{-- <th>Name</th>
                                    <th>Address</th>
                                    <th>Email Id</th>
                                    <th>Phone no</th>
                                    <th>Quantity</th>
                                    <th>Product Name</th>
                                    <th>Total price</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody> --}}
                                {{-- @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id }}</td>
                                        {{-- <td>{{$order->$student->id }}</td> --}}
                                        {{-- <td>{{$order->order_id }}</td> --}}
                                        {{-- <td>{{ $order->name }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->quantities }}</td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->created_at }}</td> --}}
{{--                                       
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table> --}}
                        {{-- <div class="mt-4">
                            {{$orders->links()}}
                        </div> --}}
                    {{-- </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}} 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }

    / Order Details Section styles /
    .order-details {
      margin: 20px;
    }

    .order-card {
      background-color: #fff;
      border: 1px solid #e1e1e1;
      border-radius: 10px;
      margin-bottom: 20px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-details h2 {
      color: #343a40;
      border-bottom: 2px solid #343a40;
      padding-bottom: 10px;
    }

    .order h4 {
      color: #343a40;
    }

    .order hr {
      margin-top: 10px;
      margin-bottom: 10px;
      border: 0;
      border-top: 5px solid #007bff; / Flipkart Blue /
    }

    .order p {
      margin-bottom: 10px;
      color: #495057;
    }

    .order p strong {
      color: #343a40;
    }

    .order-date {
      color: #6c757d;
    }

    .customer-details {
      margin-bottom: 20px;
      height: 212px;
    }

    .customer-details p {
      margin-bottom: 5px;
    }

    footer {
      padding: 20px;
      background-color: #f8f9fa;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Order Details Section -->
  <div class="container order-details">
    <h2 style="text-align: center;">Order Details</h2>
    <div class="row"  style="margin-left: 80px;">
            <div class="col-md-6">
                <section>
                    @foreach ($orders as $order)
                    <div class="order-card">
                        <div class="customer-details">
                            <h4>Customer Details</h4>
                            <p><strong>Order ID:</strong> {{ $order->id }}</p>
                            <p><strong>User Name:</strong> {{ $order->student->name }}</p>
                            <p><strong>Phone:</strong> {{ $order->student->phone }}</p>
                            <p><strong>Address:</strong> {{ $order->student->city }}</p>
                            <p><strong>Email Id:</strong> {{ $order->student->email }}</p>
                            <a href="{{ route('orders.view', ['orderId' => $order->id]) }}" class="btn btn-info">View Order</a>


                        </div>
                    </div>
                    @endforeach
                </section>
            </div>
      {{-- <div class="col-md-5">
        @foreach ($orders as $order)
        <div class="order-card">
          <hr>
          <h4>Order Id:{{ $order->id }}</h4>
          <p><strong>Product:</strong> {{ $order->product_names }}</p>
          <p><strong>Quantity:</strong> {{ $order->quantities }}</p>
          <p><strong>Total Price:</strong> ${{ $order->total }}</p>
          <p class="order-date"><strong>Order Date & Time:</strong> {{ $order->created_at }}</p>
        </div>
        @endforeach
      </div> --}}
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


@endsection

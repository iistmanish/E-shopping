@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student CRUD</title>
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
                        <h3><b>Product Table</b>
                           
                        </h3>
            
                    </div>
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <form action="{{ route('products.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    <div class="col-md-9 text-md-end"> 
                                    <a class="btn btn-success btn-sm float-right"  href="{{ route('products.create') }}">Create Product</a>
                                </div> 
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
                                
                                    <!-- Table headers -->
                                    <tr class="one">
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>MRP</th>
                                        <th>Selling Price</th>
                                        <th>Product Image</th>
                                        <th>Multiple Image</th>
                                        <th>Is Stock</th>
                                        <th>Available Quantity</th>
                                        <th>Status</th>
                                        <th>Category ID</th>
                                        <th>Brand ID</th>
                                        <th>Action</th>
                                    </tr> 
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <!-- Table data -->
                                        
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>{{ $product->mrp }}</td>
                    <td>{{ $product->selling_price }}</td>
                    <td>
                                    
                        <img src="{{asset($product->product_image) }}" width="70px" height="70px" >
                    </td>
                    <td>
                        @if(is_array($product->multiple_image))
                            @foreach($product->multiple_image as $image)
                                <img src="{{ asset($image) }}" width="50px" height="50px" >
                            @endforeach
                        @endif
                    </td>
                    
                    <td>{{ $product->is_stock }}</td>
                    <td>{{ $product->available_quantity }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->brand_id }}</td>
                 
                    <td class="btn-group-sm" role="group">
                        <form action="{{ route('products.destroy', ['product' => $product]) }}"  style="display:flex; gap:10px;"; method="POST" style="display: flex;" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            <a href="{{ route('products.edit', ['product' => $product]) }}" class="btn btn-primary mr-1">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{$products->links()}}
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


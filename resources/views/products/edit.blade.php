@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product Update Form</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Update Product</b></h3>
                    </div>
                <div>
                    {{-- @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        
                    @endif --}}
                </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('products.update',['product'=>$product])}}">
                            @csrf
                           @method('put')
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" required>
                            </div>

                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" required>{{ $product->product_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="mrp">MRP</label>
                                <input type="text" class="form-control" id="mrp" name="mrp" value="{{ $product->mrp }}" required>
                            </div>

                            <div class="form-group">
                                <label for="selling_price">Selling Price</label>
                                <input type="text" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" required>
                            </div>

                            <div class="form-group">
                                <label for="product_image">Product Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="multiple_image">Multiple Images</label>
                                <input type="file" class="form-control" id="multiple_image" name="multiple_image[]" accept="image/*" multiple>
                            </div>

                            <div class="form-group">
                                <label for="is_stock">Is Stock</label>
                                <select class="form-control" id="is_stock" name="is_stock" required>
                                    <option value="yes" @if($product->is_stock === 'yes') selected @endif>Yes</option>
                                    <option value="no" @if($product->is_stock === 'no') selected @endif>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="available_quantity">Available Quantity</label>
                                <input type="text" class="form-control" id="available_quantity" name="available_quantity" value="{{ $product->available_quantity }}" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active" @if($product->status === 'active') selected @endif>Active</option>
                                    <option value="disabled" @if($product->status === 'disabled') selected @endif>Disabled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category ID</label>
                                <input type="text" class="form-control" id="category_id" name="category_id" value="{{ $product->category_id }}" required>
                            </div>

                            <div class="form-group">
                                <label for="brand_id">Brand ID</label>
                                <input type="text" class="form-control" id="brand_id" name="brand_id" value="{{ $product->brand_id }}" required>
                            </div>

                           

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
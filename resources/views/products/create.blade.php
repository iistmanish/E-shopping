@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product Registration Form</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
        }
    </style>
</head>
<?php
$product = '';
?>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> <h3> <b>Add Product</b></h3></div>
                 {{-- <div>
                    @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>  
                    @endif
                </div>  --}}
                    <div class="card-body">
                        <form method="POST" action="{{route('products.store',['product'=>$product])}}" enctype="multipart/form-data">
                            @csrf
                           @method('post')
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                         

                            
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="mrp">MRP</label>
                                <input type="text" class="form-control" id="mrp" name="mrp" required>
                            </div>

                            <div class="form-group">
                                <label for="selling_price">Selling Price</label>
                                <input type="text" class="form-control" id="selling_price" name="selling_price" required>
                            </div>

                            <div class="form-group">
                                <label for="product_image">Product Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image"  required>
                            </div>
                            <div class="form-group">
                                <label for="multiple_image">Multiple Images</label>
                                <input type="file" class="form-control" id="multiple_image" name="multiple_images[]" multiple>
                            </div>

                            <div class="form-group">
                                <label for="is_stock">Is Stock</label>
                                <select class="form-control" id="is_stock" name="is_stock" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="available_quantity">Available Quantity</label>
                                <input type="text" class="form-control" id="available_quantity" name="available_quantity" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                            </div>

                           <!-- Product details fields -->

<div class="form-group">
    <label for="categories">Categories</label>
    <select class="form-control" id="categories" name="categories[]" multiple>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            <!-- Add options for subcategories and further subcategories dynamically using JavaScript -->
        @endforeach
    </select>
</div>

                            

<div class="form-group">
    <label for="brand_id">Brand</label>
    <select class="form-control" id="brand_id" name="brand_id" required>
        <option value="">Select Brand</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
        @endforeach
    </select>
</div>


                           

                            <button type="submit" class="btn btn-primary">Submit</button>
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
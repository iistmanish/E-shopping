@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Add category</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
        }
        .card {
            height: 560px;
        }
    </style>
</head>
<body>
    <?php 
    $category ='';
    ?>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Add Category</b></h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store', ['category' => $category]) }}">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                @error('name')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent Id</label><br>
                                <select class="form-control"  id="parent_id" name="parent_id" value="" required>
                                      <option value="">Select Category</option>
                                        <option value="1">Electronics</option>
                                        <option value="2">Women Western</option>
                                        <option value="3">Bags & Footwear</option>
                                        <option value="4">Home & Kitchen</option>
                                        <option value="5">Jawellery & Accessories</option>
                                        <option value="6">Beauty & Personal Care</option>
                                        <option value="7">Kids</option>
                                        <option value="8">Men</option>
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
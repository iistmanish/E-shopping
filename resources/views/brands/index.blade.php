
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
                        <h3><b>Brands Table</b>
                           
                        </h3>
            
                    </div>
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <form action="{{ route('brands.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    <div class="col-md-9 text-md-end"> 
                                    <a class="btn btn-success btn-sm float-right"  href="{{ route('brands.create') }}">Add brand</a>
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
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->status}}</td>
                   
                    <td class="btn-group-sm" role="group">
                        <form action="{{ route('brands.destroy', ['brand' => $brand]) }}"  style="display:flex; gap:10px;"; method="POST" style="display: flex;" onsubmit="return confirm('Are you sure you want to delete this brand?')">
                            <a href="{{ route('brands.edit', ['brand' => $brand]) }}" class="btn btn-primary mr-1">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class=mt-4>
        {{$brands->links()}}
    </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
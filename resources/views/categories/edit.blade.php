@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Category Update Form</title>
    <style>
       
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
        }
        .card{
            height: 550px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update Category Form</div>
                {{-- <div> --}}
                    {{-- @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        
                    @endif --}}
                {{-- </div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{route('categories.update',['category'=>$category])}}">
                            @csrf
                           @method('put')
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" required>
                                @error('name')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>

                           

                            <div class="form-group">
                                <label for="status">Status</label>
                                
                                    <select class="form-control" id="status" name="status" value="{{$category->status}}" required>
                                        <option value="active">Active</option>
                                        <option value="disabled">Disabled</option>
                                    </select>
                             </div>
                                
                        

                             <div class="form-group">
                                <label for="parent_id">Parent Id</label>
                                <select class="form-control" id="parent_id" name="parent_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $categoryOption)
                                        <option value="{{ $categoryOption->id }}" {{ $category->parent_id == $categoryOption->id ? 'selected' : '' }}>
                                            {{ $categoryOption->name }}
                                        </option>
                                    @endforeach
                                </select>
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
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>edit Form</title>
    <style>
        body {
            background-color:  #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
        }
        .card{
            height: 560px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update Brand Form</div>
                {{-- <div> --}}
                    {{-- @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        
                    @endif --}}
                {{-- </div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{route('brands.update',['brand'=>$brand])}}">
                            @csrf
                           @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$brand->name}}" required>
                                @error('name')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>

                           

                            <div class="form-group">
                                <label for="status">Status</label>
                                
                                    <select class="form-control" id="status" name="status" value="{{$brand->status}}" required>
                                        <option value="active">Active</option>
                                        <option value="disabled">Disabled</option>
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
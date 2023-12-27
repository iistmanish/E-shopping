@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users CRUD</title>
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
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Users Table</b>
                           
                        </h3>
            
                    </div>
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <form action="{{ route('students.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    <div class="col-md-9 text-md-end"> 
                                    <a class="btn btn-success btn-sm float-right"  href="{{ route('students.create') }}">Add User</a>
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
                <tr class="tablerow">
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone No</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->password }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->city }}</td>
                 
                    <td class="btn-group-sm" role="group">
                        <form action="{{ route('students.destroy', ['student' => $student]) }}"  style="display:flex; gap:10px;"; method="POST" style="display: flex;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            <a href="{{ route('students.edit', ['student' => $student]) }}" class="btn btn-primary mr-1">Edit</a>
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
        {{$students->links()}}
    </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
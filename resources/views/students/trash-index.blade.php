@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User CRUD</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->


    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 10px;
        }
        .container {
            max-width: 800px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4"> Trashed Student Table</h2>

        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a class="btn btn-info btn-sm" href="{{ route('students.index') }}">Back</a>
                
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
                        <form action="{{ route('students.destroy', ['student' => $student]) }}" method="POST" style="display: flex;">
                            <a href="{{ route('students.restore', ['id' => $student]) }}" class="btn btn-primary">Restore</a>
                            {{-- @csrf
                            @method('DELETE') --}}
                            <a href="{{ route('students.deletePermanently', ['id' => $student]) }}" class="btn btn-danger">Delete Forever</a>
                            {{-- <button type="submit" class="btn btn-danger">Delete Forever</button> --}}
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
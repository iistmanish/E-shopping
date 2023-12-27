<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f4f4;
        }
        .profile-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .profile-details {
            margin-bottom: 20px;
        }
        .profile-details h5 {
            margin-bottom: 5px;
        }
        .profile-details p {
            color: #555;
            margin-bottom: 10px;
        }
        .btn-group {
            margin-top: 20px;
        }
        .manish{
       margin-left: 465px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-card">
                    <div class="manish">
                    <a href="{{ route('user.edit') }}" class="btn btn-primary">
                        <i class="far fa-edit "></i>
                    </a>
                    </div>
                    
                    <div class="text-center">
                        <h2>User Profile</h2>
                    </div>
                    
                    <div class="profile-details">
                        <h5>Full Name</h5>
                        <p>{{ $user->name }}</p>
                        <h5>Email:</h5>
                        <p>{{ $user->email }}</p>
                        <h5>Phone:</h5>
                        <p>{{ $user->phone }}</p>
                        <h5>City:</h5>
                        <p>{{ $user->city }}</p>
                        <!-- Add more user details here -->
                    </div>
                    <!-- Change Password button/link -->
                   
                    <div class="btn-group d-flex justify-content-center">
                        <a href="{{route('user.password.change')}}" class="btn btn-dark mr-2">Change Password</a>
                        <a href="{{ route('shopping.logout') }}" class="btn btn-danger ml-2">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

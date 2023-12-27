{{-- <div class="container mt-5">
    <h2>My Wishlist</h2>
    <div class="row">
        @foreach($wishlistItems as $item)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset($item->product->product_image) }}" class="card-img-top" alt="{{ $item->product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->product->name }}</h5>
                    <p class="card-text">{{ $item->product->product_description }}</p>
                    <p class="card-text">MRP: ${{ $item->product->mrp }}</p>
                    <!-- Add more details or buttons if needed -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .card-body {
            padding: 15px;
        }
        .wishlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            margin: 0;
        }
        .remove-btn {
            background-color: #f00;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .delete-btn {
            background-color: #f00;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            position: absolute;
            top: 15px;
            right: 15px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .card:hover .delete-btn {
            opacity: 1;
        }
    </style>
    <title>Your Wishlist</title>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header wishlist-header">
                <h2>My Wishlist ({{ session('wishlistCount', 0) }})</h2>
                
            </div>
            <div class="card-body">
                @if($wishlistItems->count() > 0)
                    <div class="row">
                        @foreach($wishlistItems as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card position-relative">
                                   
                                    <img src="{{ asset($item->product->product_image) }}" class="card-img-top" alt="{{ $item->product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->product->name }}</h5>
                                        <p class="card-text">{{ $item->product->product_description }}</p>
                                        <p class="card-text">MRP: ${{ $item->product->mrp }}</p>
                                    </div>
                                </div>
                                <form method="post" action="{{ route('wishlist.remove', ['wishlist' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Your wishlist is empty.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js" integrity="sha384-Zmp9feVn6aIqE+geE7Kk6qc5k1fUJ5pL9/eJA4LZbX1MzXxFOv1YaR4iN5DyI6be" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyUtFz/Nl7JqHRnU4tQbBovca1p2t7xj" crossorigin="anonymous"></script>

</body>
</html>


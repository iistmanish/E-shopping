<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">Shipping Information</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Quantity</th>
                                        <th>Product Name</th>
                                        <th>Total price</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                     <!-- Assuming $orders is correctly passed from the backend -->
                                     @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->email}}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->quantities }}</td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>{{ $order->total }}</td>
                                           
                                        </tr>
                                    @endforeach 
                                    <!-- Assuming $orders loop ends here -->
                                </tbody>
                            </table>
                            <!-- Pagination assuming $orders paginated from backend -->
                             {{-- <div class="mt-4">
                                {{$orders->links()}}
                            </div>  --}}
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 
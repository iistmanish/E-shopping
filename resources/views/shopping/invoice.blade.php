<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Your other scripts and styles -->
    <title>Invoice</title>
    <style>
        /* Additional styles can go here */
        /* Customize as per your requirements */
    </style>
</head>
<body>
    {{-- <div class="container">
        <div class="row"> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-center" style="background-color: #8ed9f0; padding: 10px;">
                                    <h2 style="color: #151718; margin: 0;">Order-Invoice</h2>
                                </div>
                                <p>Order ID: {{ $orders->id }}</p>
                                <p><strong>Order Date:</strong> {{ $orders->created_at }}</p>
                                <p><strong>Sold By:</strong> E-Shopping</p>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Add From Address:</h4>
                                        @if($orders->student) <!-- Check if the student relationship exists -->
                                        <p>User ID: {{ $orders->student->id }}</p>
                                        <p>User Name: {{ $orders->student->name }}</p>
                                        <p>Email Address: {{ $orders->student->email }}</p>
                                        <p>Contact No: {{ $orders->student->phone }}</p>
                                        <p>City: {{ $orders->student->city }}</p>
                                    @else
                                        <p>No student information available</p>
                                    @endif
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <h4>(Shipping Address)To:</h4>
                                        @if($orders)
                                            <p>Name: {{ $orders->name }}</p>
                                            <p>Address: {{ $orders->address }}</p>
                                            <p>Mobile No: {{ $orders->phone }}</p>
                                            <p>Payment Mode: {{ $orders->payment_mode }}</p>
                                        @else
                                            <p>No data found</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Payment Mode</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($orders)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $orders->product_name }}</td>
                                                    <td>{{ $orders->quantities }}</td>
                                                    <td>{{ $orders->payment_mode }}</td>
                                                    <td>{{ $orders->total }}</td>
                                                </tr>
                                                <!-- More rows if needed -->
                                            @else
                                                <tr>
                                                    <td colspan="5">No data found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Any additional information or notes -->
                                    </div>
                                    <div class="col-sm-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Delivery Charges</strong></td>
                                                    <td>$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total</strong></td>
                                                    <td>{{ $orders->total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <p class="signature"><strong>Signature:</strong> ________________________</p>
                                <div class="text-center">
                                    <a href="{{ route('invoice.pdf',['orderId' => $orders->id]) }}" class="btn btn-success">Download PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        {{-- </div>
    </div> --}}
</body>
</html>

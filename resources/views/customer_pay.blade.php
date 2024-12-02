@extends('layouts.layout_navbar_cart')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Payment</h2>

    <!-- QR Code for Payment -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/qrispayment.jpeg') }}" alt="QR Code for Payment" class="img-fluid" style="max-width: 250px;">
    </div>

    <!-- Customer Details and Final Price -->
    <div class="order-details text-center">
        <p><strong>Name:</strong> {{ $customerName }}</p>
        <p><strong>Email:</strong> {{ $email }}</p> <!-- Display email here -->
        <p><strong>Table Number:</strong> {{ $tableNumber }}</p>
        <p><strong>Final Price:</strong> Rp. {{ number_format($finalPrice, 0, ',', '.') }}</p>
    </div>    

    <!-- Finished Button to Submit Order -->
    <div class="text-center mt-4">
        <form action="{{ route('orders.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $orderId }}">
            <input type="hidden" name="cart_data" value="{{ json_encode($cartItems) }}">
            <input type="hidden" name="final_price" value="{{ $finalPrice }}">
            <input type="hidden" name="customer_name" value="{{ $customerName }}">
            <input type="hidden" name="table_number" value="{{ $tableNumber }}">
            <button type="submit" class="btn btn-success">Finish</button>
        </form>                       
    </div>
</div>
@endsection

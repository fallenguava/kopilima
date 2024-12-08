@extends('layouts.layout_navbar_cart')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h2 class="mb-4" style="font-weight: bold; color: #03045e;">Confirm Your Payment</h2>
    </div>

    <!-- QR Code for Payment -->
    <div class="payment-section text-center mb-4 p-4 rounded shadow" style="background-color: #f8f9fa;">
        <h4 class="mb-3" style="color: #0077b6;">Scan the QR Code</h4>
        <img src="{{ asset('fake.png') }}" alt="QR Code for Payment" class="img-fluid" style="max-width: 200px; border: 3px solid #0077b6; border-radius: 10px;">
        <p class="mt-2" style="font-size: 0.9rem; color: #6c757d;">Use your favorite payment app to complete the payment.</p>
    </div>

    <!-- Customer Details and Final Price -->
    <div class="order-details p-4 rounded shadow mb-4" style="background-color: #ffffff;">
        <h4 class="text-center" style="color: #03045e; font-weight: bold;">Order Details</h4>
        <ul class="list-unstyled mt-3">
            <li class="d-flex justify-content-between">
                <span><strong>Name:</strong></span>
                <span>{{ $customerName }}</span>
            </li>
            <li class="d-flex justify-content-between">
                <span><strong>Email:</strong></span>
                <span>{{ $email }}</span>
            </li>
            <li class="d-flex justify-content-between">
                <span><strong>Table Number:</strong></span>
                <span>{{ $tableNumber }}</span>
            </li>
            <li class="d-flex justify-content-between">
                <span><strong>Final Price:</strong></span>
                <span style="color: #0077b6; font-weight: bold;">Rp. {{ number_format($finalPrice, 0, ',', '.') }}</span>
            </li>
        </ul>
    </div>

    <!-- Finished Button to Submit Order -->
    <div class="text-center mt-4">
        <form action="{{ route('orders.submit') }}" method="POST" class="p-4 rounded shadow" style="background-color: #f8f9fa;">
            @csrf
            <input type="hidden" name="order_id" value="{{ $orderId }}">
            <input type="hidden" name="cart_data" value="{{ json_encode($cartItems) }}">
            <input type="hidden" name="final_price" value="{{ $finalPrice }}">
            <input type="hidden" name="customer_name" value="{{ $customerName }}">
            <input type="hidden" name="table_number" value="{{ $tableNumber }}">

            <p class="text-muted mb-4">Double-check your details before proceeding.</p>
            <button type="submit" class="btn btn-success w-100" style="font-size: 1.2rem; font-weight: bold;">Confirm and Pay</button>
        </form>
    </div>
</div>
@endsection

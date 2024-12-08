@extends('layouts.layout_navbar_empty')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Your Cart</h2>

    <!-- Cart Items List -->
    <div class="cart-items">
        @if(isset($cartItems) && count($cartItems) > 0)
            @foreach($cartItems as $item)
                @if(isset($item['id']))
                    <div class="row cart-item mb-3 align-items-center" id="cart-item-{{ $item['id'] }}">
                        <div class="col-3">
                            <img src="{{ asset('storage/uploads/menu_image/' . ($item['photo'] ?? 'default.jpg')) }}" alt="{{ $item['name'] }}" class="img-fluid rounded">
                        </div>
                        <div class="col-6">
                            <h5>{{ $item['name'] }}</h5>
                            <p>Rp. {{ number_format($item['price'], 0, ',', '.') }}</p>
                            <div class="d-flex align-items-center">
                                <button onclick="decreaseQuantity('{{ $item['id'] }}')" class="btn btn-outline-secondary btn-sm">-</button>
                                <span class="mx-2" id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                <button onclick="increaseQuantity('{{ $item['id'] }}')" class="btn btn-outline-secondary btn-sm">+</button>
                                <button onclick="removeFromCart('{{ $item['id'] }}')" class="btn btn-danger btn-sm ms-2">x</button>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <p id="total-price-{{ $item['id'] }}">Total: Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>

    <!-- Cart Summary -->
    <div class="cart-summary mt-4">
        <h4>Order Summary</h4>
        <p id="sub-total">Sub Total: {{ number_format($subTotal, 0, ',', '.') }}</p>
        <p id="final-price">Final Price (Sub Total + 17% tax): {{ number_format($finalPrice, 0, ',', '.') }}</p>
    </div>

    <!-- Customer Details Form -->
    <div class="customer-details mt-4">
        <form action="{{ route('cart.process_checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="cart_data" value="{{ json_encode($cartItems) }}">
            <input type="hidden" name="final_price" value="{{ $finalPrice }}">
        
            <div class="mb-3">
                <label for="customer_name">Your Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>

            <div class="mb-3">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        
            <div class="mb-3">
                <label for="table_number">Table Number</label>
                <input type="number" class="form-control" id="table_number" name="table_number" required>
            </div>
        
            <button type="submit" class="btn btn-success w-100">Pay</button>
        </form>                      
    </div>
</div>

<script>
    let cart = @json($cartItems);

    function updateCartUI() {
        let subTotal = 0;

        for (let itemId in cart) {
            let item = cart[itemId];
            let itemTotal = item.price * item.quantity;
            subTotal += itemTotal;

            // Update item quantity and total price in the UI
            document.getElementById(`quantity-${itemId}`).innerText = item.quantity;
            document.getElementById(`total-price-${itemId}`).innerText = `Total: Rp. ${formatRupiah(itemTotal)}`;
        }

        // Update Order Summary
        let finalPrice = subTotal * 1.17; // 17% tax included
        document.getElementById('sub-total').innerText = `Sub Total: Rp. ${formatRupiah(subTotal)}`;
        document.getElementById('final-price').innerText = `Final Price (Sub Total + 17% tax): Rp. ${formatRupiah(finalPrice)}`;
    }

    // Format number to Rupiah
    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount);
    }

    // Increase item quantity
    function increaseQuantity(itemId) {
        if (cart[itemId]) {
            cart[itemId].quantity += 1;
            updateCartUI();
        }
    }

    // Decrease item quantity (not below 1)
    function decreaseQuantity(itemId) {
        if (cart[itemId] && cart[itemId].quantity > 1) {
            cart[itemId].quantity -= 1;
        } else {
            delete cart[itemId];
            document.getElementById(`cart-item-${itemId}`).remove();
        }
        updateCartUI();
    }

    // Remove an item from the cart
    function removeFromCart(itemId) {
        if (cart[itemId]) {
            delete cart[itemId];
            document.getElementById(`cart-item-${itemId}`).remove();
        }
        updateCartUI();
    }

    // Initial UI setup on page load
    document.addEventListener('DOMContentLoaded', function () {
        updateCartUI(); // Render the initial cart UI
    });
</script>

@endsection

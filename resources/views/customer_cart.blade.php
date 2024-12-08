<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Kopi Lima</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #90e0ef, #caf0f8);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        h2, h4 {
            color: #03045e;
        }
        .btn-success {
            background-color: #0077b6;
            border: none;
        }
        .btn-success:hover {
            background-color: #03045e;
        }
        .btn-outline-secondary {
            border-color: #0077b6;
            color: #0077b6;
        }
        .btn-outline-secondary:hover {
            background-color: #0077b6;
            color: #fff;
        }
        footer {
            background: #03045e;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            font-size: 0.9rem;
            width: 100%;
        }
        footer a {
            color: #00b4d8;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand mx-auto" href="#" style="font-weight: 700; color: #03045e;">Kopi Lima</a>
</nav>

<div class="container my-5">
    <h2 class="text-center mb-4">Your Cart</h2>

    <!-- Cart Items List -->
    <div class="cart-items">
        @if(isset($cartItems) && count($cartItems) > 0)
            @foreach($cartItems as $item)
                @if(isset($item['id']))
                    <div class="row cart-item mb-4 align-items-center" id="cart-item-{{ $item['id'] }}">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/uploads/menu_image/' . ($item['photo'] ?? 'default.jpg')) }}" alt="{{ $item['name'] }}" class="img-fluid rounded shadow">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $item['name'] }}</h5>
                            <p>Rp. {{ number_format($item['price'], 0, ',', '.') }}</p>
                            <div class="d-flex align-items-center mt-2">
                                <button onclick="decreaseQuantity('{{ $item['id'] }}')" class="btn btn-outline-secondary btn-sm">-</button>
                                <span class="mx-3" id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                <button onclick="increaseQuantity('{{ $item['id'] }}')" class="btn btn-outline-secondary btn-sm">+</button>
                                <button onclick="removeFromCart('{{ $item['id'] }}')" class="btn btn-danger btn-sm ms-3">Remove</button>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <p id="total-price-{{ $item['id'] }}">Total: Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <p class="text-center text-muted">Your cart is empty.</p>
        @endif
    </div>

    <!-- Cart Summary -->
    <div class="cart-summary mt-5 p-4 rounded shadow" style="background-color: #f1f1f1;">
        <h4>Order Summary</h4>
        <p id="sub-total">Sub Total: Rp. {{ number_format($subTotal, 0, ',', '.') }}</p>
        <p id="final-price">Final Price (Sub Total + 17% tax): Rp. {{ number_format($finalPrice, 0, ',', '.') }}</p>
    </div>

    <!-- Customer Details Form -->
    <div class="customer-details mt-5">
        <form action="{{ route('cart.process_checkout') }}" method="POST" class="p-4 rounded shadow" style="background-color: #ffffff;">
            @csrf
            <h4>Customer Details</h4>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="table_number" class="form-label">Table Number</label>
                <input type="number" class="form-control" id="table_number" name="table_number" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Pay</button>
        </form>
    </div>
</div>

<footer>
    &copy; 2024 Kopi Lima. All Rights Reserved. | <a href="#privacy">Privacy Policy</a> | <a href="#terms">Terms of Use</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let cart = @json($cartItems);

    function updateCartUI() {
        let subTotal = 0;

        for (let itemId in cart) {
            let item = cart[itemId];
            let itemTotal = item.price * item.quantity;
            subTotal += itemTotal;

            // Update item quantity and total price in the UI
            document.getElementById(quantity-${itemId}).innerText = item.quantity;
            document.getElementById(total-price-${itemId}).innerText = Total: Rp. ${formatRupiah(itemTotal)};
        }

        // Update Order Summary
        let finalPrice = subTotal * 1.17; // 17% tax included
        document.getElementById('sub-total').innerText = Sub Total: Rp. ${formatRupiah(subTotal)};
        document.getElementById('final-price').innerText = Final Price (Sub Total + 17% tax): Rp. ${formatRupiah(finalPrice)};
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
            document.getElementById(cart-item-${itemId}).remove();
        }
        updateCartUI();
    }

    // Remove an item from the cart
    function removeFromCart(itemId) {
        if (cart[itemId]) {
            delete cart[itemId];
            document.getElementById(cart-item-${itemId}).remove();
        }
        updateCartUI();
    }

    // Initial UI setup on page load
    document.addEventListener('DOMContentLoaded', function () {
        updateCartUI(); // Render the initial cart UI
    });
</script>
</body>
</html>

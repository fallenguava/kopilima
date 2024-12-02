@extends('layouts.layout_navbar_cart')

@section('content')
<div class="container my-4">
    <!-- Floating navigation for categories -->
    <div class="floating-nav bg-light p-3 rounded shadow mb-4 sticky-top">
        <a href="#coffee" class="btn btn-outline-secondary me-2 mt-2">Coffee</a>
        <a href="#snacks" class="btn btn-outline-secondary me-2 mt-2">Snacks</a>
        <a href="#fries" class="btn btn-outline-secondary me-2 mt-2">Fries</a>
        <a href="#rice" class="btn btn-outline-secondary me-2 mt-2">Rice</a>
        <a href="#dessert" class="btn btn-outline-secondary me-2 mt-2">Dessert</a>
        <a href="#drinks" class="btn btn-outline-secondary  mt-2">Drinks</a>
    </div>

    <!-- Menu Items Section -->
    <div id="menu-items">
        <!-- Each category section -->
        <h3 id="coffee" class="my-4">Coffee</h3>
        <div class="row">
            @foreach($coffeeItems as $item)
                @include('partials.menu_item', ['item' => $item])
            @endforeach
        </div>

        <h3 id="snacks" class="my-4">Snacks</h3>
        <div class="row">
            @foreach($snackItems as $item)
                @include('partials.menu_item', ['item' => $item])
            @endforeach
        </div>

        <h3 id="fries" class="my-4">Fries</h3>
        <div class="row">
            @foreach($friesItems as $item)
                @include('partials.menu_item', ['item' => $item])
            @endforeach
        </div>

        <h3 id="rice" class="my-4">Rice</h3>
        <div class="row">
            @foreach($riceItems as $item)
                @include('partials.menu_item', ['item' => $item])
            @endforeach
        </div>

        <h3 id="dessert" class="my-4">Dessert</h3>
        <div class="row">
            @foreach($dessertItems as $item)
                @include('partials.menu_item', ['item' => $item])
            @endforeach
        </div>

        <h3 id="drinks" class="my-4">Drinks</h3>
        <div class="row">
            @foreach($drinkItems as $item)
                @include('partials.menu_item', ['item' => $item])
            @endforeach
        </div>
    </div>

    <!-- Floating Proceed Button -->
    <div id="proceed-container" class="fixed-bottom bg-light p-3 text-center d-none">
        <a href="{{ route('cart.view') }}" class="btn btn-success w-100">Proceed to Cart (Items: <span id="total-quantity">0</span>)</a>
    </div>
</div>

<script>
    let cart = {};

    // Function to initialize cart count on page load
    function initializeCartCount() {
        fetch("{{ route('cart.view') }}")
            .then(response => response.json())
            .then(data => {
                const totalQuantity = Object.values(data).reduce((acc, item) => acc + item.quantity, 0);
                document.getElementById("cart-count-badge").innerText = totalQuantity;
            })
            .catch(error => console.error("Error fetching cart data:", error));
    }

    function addToCart(itemId, itemName, itemPrice) {
        if (!cart[itemId]) {
            cart[itemId] = { id: itemId, name: itemName, price: itemPrice, quantity: 1 };
        } else {
            cart[itemId].quantity += 1;
        }

        // AJAX request to add the item to the server-side session cart
        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({ id: itemId })
        })
        .then(response => response.json())
        .then(data => {
            updateProceedButton();
            updateCartCountBadge();
        })
        .catch(error => console.error("Error:", error));
    }

    function updateProceedButton() {
        let totalQuantity = Object.values(cart).reduce((acc, item) => acc + item.quantity, 0);
        document.getElementById('total-quantity').innerText = totalQuantity;

        const proceedContainer = document.getElementById('proceed-container');
        if (totalQuantity > 0) {
            proceedContainer.classList.remove('d-none');
        } else {
            proceedContainer.classList.add('d-none');
        }
    }

    // Function to update the cart count badge
    function updateCartCountBadge() {
        const totalQuantity = Object.values(cart).reduce((acc, item) => acc + item.quantity, 0);
        document.getElementById("cart-count-badge").innerText = totalQuantity;
    }

    // Initialize cart count when page loads
    document.addEventListener("DOMContentLoaded", () => {
        initializeCartCount();
    });

</script>
@endsection

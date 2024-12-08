@extends('layouts.layout_navbar_cart')

@section('content')
<div class="container my-4">
    <!-- Floating navigation for categories -->
    <div class="floating-nav bg-light p-3 rounded shadow mb-4 sticky-top d-flex overflow-auto">
        <a href="#coffee" class="category-btn me-2 mt-2">
            <i class="bi bi-cup-hot"></i> Coffee
        </a>
        <a href="#snacks" class="category-btn me-2 mt-2">
            <i class="bi bi-basket-fill"></i> Snacks
        </a>
        <a href="#fries" class="category-btn me-2 mt-2">
            <i class="bi bi-boxes"></i> Fries
        </a>
        <a href="#rice" class="category-btn me-2 mt-2">
            <i class="bi bi-basket3-fill"></i> Rice
        </a>
        <a href="#dessert" class="category-btn me-2 mt-2">
            <i class="bi bi-ice-cream"></i> Dessert
        </a>
        <a href="#drinks" class="category-btn mt-2">
            <i class="bi bi-cup-straw"></i> Drinks
        </a>
    </div>    

    <!-- Menu Items Section -->
    <div id="menu-items">
        @foreach(['coffee' => $coffeeItems, 'snacks' => $snackItems, 'fries' => $friesItems, 'rice' => $riceItems, 'dessert' => $dessertItems, 'drinks' => $drinkItems] as $category => $items)
            <h3 id="{{ $category }}" class="my-4 text-primary text-uppercase" style="font-size: 2rem; font-weight: bold;">{{ ucfirst($category) }}</h3>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @foreach($items as $item)
                    @include('partials.menu_item', ['item' => $item])
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Floating Proceed Button -->
    <div id="proceed-container" class="fixed-bottom bg-light p-3 text-center d-none shadow-lg">
        <a href="{{ route('cart.view') }}" class="btn btn-success w-100">
            Proceed to Cart (Items: <span id="total-quantity">0</span>)
        </a>
    </div>
</div>

<script>
    let cart = {};

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
        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: itemId })
        }).then(() => {
            updateProceedButton();
            updateCartCountBadge();
        }).catch(error => console.error("Error:", error));
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

    function updateCartCountBadge() {
        const totalQuantity = Object.values(cart).reduce((acc, item) => acc + item.quantity, 0);
        document.getElementById("cart-count-badge").innerText = totalQuantity;
    }

    document.addEventListener("DOMContentLoaded", () => {
        initializeCartCount();
    });
</script>
@endsection

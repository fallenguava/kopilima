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
        @foreach (['coffee' => $coffeeItems, 'snacks' => $snackItems, 'fries' => $friesItems, 'rice' => $riceItems, 'dessert' => $dessertItems, 'drinks' => $drinkItems] as $category => $categoryItems)
            <h3 id="{{ $category }}" class="my-4 text-primary text-uppercase" style="font-size: 2rem; font-weight: bold;">{{ ucfirst($category) }}</h3>
            <div class="row row-cols-1 row-cols-md-2 g-3 mb-2 mt-2 ml-2 mr-2">
                @foreach ($categoryItems as $item)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <!-- Adjusted image with consistent size -->
                            <img 
                                src="{{ asset('storage/uploads/menu_image/' . $item->photo) }}" 
                                class="card-img-top" 
                                alt="{{ $item->name }}" 
                                style="width: 100%; height: 200px; object-fit: cover; border-bottom: 1px solid #e0e0e0;">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $item->name }}</h5>
                                <p class="card-text">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                                <div id="quantity-controls-{{ $item->id }}">
                                    <button id="add-btn-{{ $item->id }}" onclick="addToCart('{{ $item->id }}', '{{ $item->name }}', {{ $item->price }})" class="btn btn-primary w-100">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                cart = data;
                updateUI();
            })
            .catch(error => console.error("Error fetching cart data:", error));
    }

    function addToCart(itemId, itemName, itemPrice) {
        if (!cart[itemId]) {
            cart[itemId] = { id: itemId, name: itemName, price: itemPrice, quantity: 1 };
        } else {
            cart[itemId].quantity += 1;
        }
        updateServerCart(itemId, cart[itemId].quantity);
        updateUI();
    }

    function decreaseQuantity(itemId) {
        if (cart[itemId] && cart[itemId].quantity > 1) {
            cart[itemId].quantity -= 1;
        } else if (cart[itemId]) {
            delete cart[itemId];
        }
        updateServerCart(itemId, cart[itemId]?.quantity || 0);
        updateUI();
    }

    function updateServerCart(itemId, quantity) {
        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: itemId, quantity: quantity })
        }).catch(error => console.error("Error updating cart on server:", error));
    }

    function updateUI() {
        let totalQuantity = 0;

        for (let itemId in cart) {
            const item = cart[itemId];
            totalQuantity += item.quantity;

            const controls = document.getElementById(`quantity-controls-${itemId}`);
            controls.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('${itemId}')">-</button>
                    <span class="mx-2">${item.quantity}</span>
                    <button class="btn btn-outline-secondary btn-sm" onclick="addToCart('${itemId}', '${item.name}', ${item.price})">+</button>
                </div>
            `;
        }

        document.getElementById('total-quantity').innerText = totalQuantity;
        document.getElementById('cart-count-badge').innerText = totalQuantity;

        const proceedContainer = document.getElementById('proceed-container');
        if (totalQuantity > 0) {
            proceedContainer.classList.remove('d-none');
        } else {
            proceedContainer.classList.add('d-none');
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        initializeCartCount();
    });
</script>
@endsection

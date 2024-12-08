<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <img 
            src="{{ asset('storage/uploads/menu_image/' . $item->photo) }}" 
            class="card-img-top" 
            alt="{{ $item->name }}" 
            style="height: 200px; object-fit: cover;"
        >
        <div class="card-body d-flex flex-column justify-content-between" style="background-color: #caf0f8;">
            <div>
                <h5 class="card-title text-dark" style="font-weight: bold;">{{ $item->name }}</h5>
                <p class="card-text text-primary" style="font-size: 1.1rem; font-weight: 600;">
                    Rp. {{ number_format($item->price, 0, ',', '.') }}
                </p>
            </div>
            <div>
                <button 
                    id="add-btn-{{ $item->id }}" 
                    onclick="addToCart('{{ $item->id }}', '{{ $item->name }}', {{ $item->price }})" 
                    class="btn btn-primary w-100" 
                    style="background-color: #0077b6; border: none; font-weight: bold; font-size: 1rem;">
                    Add to Cart
                </button>
                <div id="quantity-controls-{{ $item->id }}" style="display: none;">
                    <button 
                        onclick="removeFromCart('{{ $item->id }}')" 
                        class="btn btn-danger w-100 mt-2" 
                        style="font-weight: bold;">
                        Remove
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

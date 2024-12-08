<div class="col-6 col-md-4 mb-4">
    <div class="card h-100 shadow-sm">
        <img src="{{ asset('storage/uploads/menu_image/' . $item->photo) }}" class="card-img-top" alt="{{ $item->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $item->name }}</h5>
            <p class="card-text">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
            <button id="add-btn-{{ $item->id }}" onclick="addToCart('{{ $item->id }}', '{{ $item->name }}', {{ $item->price }})" class="btn btn-primary w-100">+</button>
            <div id="quantity-controls-{{ $item->id }}" style="display: none;">
                <button onclick="removeFromCart('{{ $item->id }}')" class="btn btn-danger w-100 mt-2">Remove</button>
            </div>
        </div>
    </div>
</div>

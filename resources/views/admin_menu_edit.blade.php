@extends('layouts.layout_navbar')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Edit Menu Item</h2>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Menu Item Form -->
    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $menu->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (Rp.)</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $menu->price }}" min="0" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $menu->category }}" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            @if($menu->photo)
                <img src="{{ asset('storage/menu_images/' . $menu->photo) }}" alt="{{ $menu->name }}" class="img-fluid mt-3" style="max-width: 150px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Menu Item</button>
    </form>
</div>
@endsection

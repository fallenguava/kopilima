@extends('layouts.layout_admin_navbar')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Menu Management</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add New Menu Item Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Add New Menu Item</a>
    </div>

    <!-- Menu Items Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (Rp.)</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menuItems as $item)
            <tr>
                <td><img src="{{ asset('storage/uploads/menu_image/' . $item->photo) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;"></td>                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->category }}</td>
                <td>
                    <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

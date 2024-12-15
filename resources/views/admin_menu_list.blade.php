@extends('layouts.layout_admin_navbar')

@section('content')
<style>
    .floating-pagination-bar {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        background-color: #ffffff;
        box-shadow: -2px 0 6px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        z-index: 1000;
        border-radius: 8px 0 0 8px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .pagination-controls {
    position: fixed;
    right: 20px;
    bottom: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    border-radius: 8px;
    z-index: 999;
    }
    .pagination-controls label {
        font-weight: bold;
        margin-right: 0.5rem;
    }

    .floating-pagination-bar select,
    .floating-pagination-bar .pagination {
        width: 100%;
        margin-bottom: 1rem;
    }

    table th {
        cursor: pointer;
    }

    table th.sortable:hover {
        text-decoration: underline;
        color: #0077b6;
    }

    @media (max-width: 768px) {
        .floating-pagination-bar {
            right: 10px;
        }

        .floating-pagination-bar select,
        .floating-pagination-bar .pagination {
            font-size: 0.85rem;
        }
    }
</style>

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
                <th class="sortable" onclick="sortTable('name')">
                    Name
                    @if ($sortField == 'name')
                        <i class="bi bi-caret-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </th>
                <th>Description</th>
                <th class="sortable" onclick="sortTable('price')">
                    Price (Rp.)
                    @if ($sortField == 'price')
                        <i class="bi bi-caret-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menuItems as $item)
            <tr>
                <td><img src="{{ asset('storage/uploads/menu_image/' . $item->photo) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;"></td>
                <td>{{ $item->name }}</td>
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

<!-- Floating Vertical Pagination Bar -->
<div class="floating-pagination-bar">
    <form id="itemsPerPageForm" method="GET" action="{{ route('admin.menu.index') }}">
        <label for="perPage">Show:</label>
        <select id="perPage" class="form-select" onchange="updatePerPage()">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
            <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>30</option>
            <option value="40" {{ $perPage == 40 ? 'selected' : '' }}>40</option>
            <option value="all" {{ $perPage == 'all' ? 'selected' : '' }}>All</option>
        </select>
    </form>

    @if ($menuItems instanceof \Illuminate\Contracts\Pagination\Paginator)
    {{ $menuItems->appends(['sort' => $sortField, 'direction' => $sortDirection, 'per_page' => $perPage])->links('vendor.pagination.bootstrap-5') }}
    @endif

</div>

<script>
    function sortTable(field) {
        const urlParams = new URLSearchParams(window.location.search);
        const currentDirection = urlParams.get('direction') || 'asc';
        const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';

        urlParams.set('sort', field);
        urlParams.set('direction', newDirection);

        window.location.search = urlParams.toString();
    }
    function updatePerPage() {
        const perPage = document.getElementById('perPage').value;
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    }
</script>
@endsection

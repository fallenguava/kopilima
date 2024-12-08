@extends('layouts.layout_admin_navbar')

@section('content')
<style>
    .dashboard-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        text-align: center;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card h3 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #0077b6;
    }
    .card p {
        font-size: 1.2rem;
        color: #4a4a4a;
    }
    .quick-actions {
        margin-top: 2rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }
    .quick-actions .btn {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    @media (max-width: 576px) {
        .card h3 {
            font-size: 1.5rem;
        }
        .card p {
            font-size: 1rem;
        }
        .quick-actions .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    }
</style>

<div class="container my-4">
    <h1 class="text-center mb-4" style="color: #03045e;">Welcome, Admin!</h1>
    <p class="text-center text-muted mb-5">Here is an overview of the current status and quick actions you can take.</p>

    <!-- Dashboard Overview -->
    <div class="dashboard-container">
        <!-- Orders Overview -->
        <div class="card">
            <h3>{{ $totalOngoingOrders }}</h3>
            <p>Ongoing Orders</p>
        </div>
        <div class="card">
            <h3>{{ $totalFinishedOrders }}</h3>
            <p>Completed Orders</p>
        </div>
        <div class="card">
            <h3>{{ $totalCanceledOrders }}</h3>
            <p>Canceled Orders</p>
        </div>

        <!-- Revenue Overview -->
        <div class="card">
            <h3>Rp. {{ number_format($grossIncome, 0, ',', '.') }}</h3>
            <p>Total Revenue</p>
        </div>
        <div class="card">
            <h3>{{ $totalMenuItems }}</h3>
            <p>Total Menu Items</p>
        </div>
        <div class="card">
            <h3>{{ $totalAdmins }}</h3>
            <p>Admin Users</p>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <h2 class="mb-4 mt-5 text-center" style="color: #03045e;">Quick Actions</h2>
    <div class="quick-actions text-center mt-4">
        <a href="{{ route('admin.menu.index') }}" class="btn btn-primary btn-lg">Manage Menu</a>
        <a href="{{ route('admin.ongoingOrders') }}" class="btn btn-success btn-lg">View Ongoing Orders</a>
        <form action="{{ route('admin.resetAndDeleteOrders') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg">Reset OrderId and Delete Orders</button>
        </form>
    </div>
</div>
@endsection

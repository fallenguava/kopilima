@extends('layouts.layout_navbar')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Active Orders</h2>

    <!-- Gross Income -->
    <div class="alert alert-info text-center p-3 mb-4" style="font-size: 1.2em; font-weight: bold;">
        Gross Income: Rp. {{ number_format($grossIncome, 0, ',', '.') }}
    </div>

    <!-- Reset and Delete Orders Button -->
    <div class="text-end mb-3">
        <form action="{{ route('admin.resetAndDeleteOrders') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Reset OrderId and Delete Orders</button>
        </form>
    </div>

    <!-- Orders Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Items</th>
                <th>Final Price</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Table Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ongoingOrders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->all_items }}</td>
                    <td>Rp. {{ number_format($order->final_price, 0, ',', '.') }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->table_number }}</td>
                    <td>
                        <!-- Finish Button -->
                        <form action="{{ route('admin.finishOrder', ['id' => $order->order_id]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Finish</button>
                        </form>
                        <!-- Cancel Button -->
                        <form action="{{ route('admin.cancelOrder', ['id' => $order->order_id]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Automatic Page Refresh Script -->
<script>
    // Refresh the page every 5 seconds (5000 ms)
    setInterval(() => {
        location.reload();
    }, 5000);
</script>
@endsection
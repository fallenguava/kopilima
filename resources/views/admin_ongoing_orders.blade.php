@extends('layouts.layout_admin_navbar')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4" style="color: #0077b6;">Active Orders</h2>

    <!-- Gross Income -->
    <div class="alert alert-info text-center p-3 mb-4 rounded" style="font-size: 1.2em; font-weight: bold; background-color: #caf0f8; color: #03045e;">
        Gross Income: Rp. {{ number_format($grossIncome, 0, ',', '.') }}
    </div>

    <!-- Reset and Delete Orders Button -->
    <div class="text-end mb-3">
        <form action="{{ route('admin.resetAndDeleteOrders') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg">Reset OrderId and Delete Orders</button>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="text-center" style="background-color: #0077b6; color: #fff;">
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
                        <td class="text-center">{{ $order->order_id }}</td>
                        <td>{{ $order->all_items }}</td>
                        <td class="text-end">Rp. {{ number_format($order->final_price, 0, ',', '.') }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td class="text-center">{{ $order->table_number }}</td>
                        <td class="text-center">
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
</div>

<!-- Automatic Page Refresh Script -->
<script>
    // Refresh the page every 10 seconds (10000 ms) for better usability
    setInterval(() => {
        location.reload();
    }, 10000);
</script>
@endsection

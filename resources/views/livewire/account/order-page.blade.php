<div>


@include('livewire.account.head')
    <div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            @include('livewire.account.sidebar')
        </div>

        <!-- Orders Content -->
        <div class="col-md-9">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">My Orders</h5>

                @if($orders->isEmpty())
                    <p class="text-muted">No orders found.</p>
                @else
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>{{ $order->orderStatus?->orderstatus_name ?? 'Pending' }}</td>
                                    <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        @foreach($order->child as $child)
                                            <span class="badge bg-secondary">
                                                {{ $child->product?->product_name }} (x{{ $child->qty }})
                                            </span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

    
</div>

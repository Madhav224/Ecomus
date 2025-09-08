<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold">Invoice</h2>
                <p class="mb-1"><strong>Order #:</strong> {{ $order->order_number }}</p>
                <p class="mb-1"><strong>Status:</strong> {{ $order->OrderStatus?->orderstatus_name }}</p>
            </div>
            <div class="col-md-6 text-end">
                <h5 class="mb-1">{{ $title }}</h5>
                <p class="mb-1">sridixtechnology001@gmail.com</p>
            </div>
        </div>

        <!-- Customer & Payment Info -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="border-bottom pb-1">Customer Info</h6>
                <p class="mb-1">{{ $user?->name }}</p>
                <p class="mb-1">{{ $user?->email }}</p>
                <p class="mb-1">+91 {{ $user?->phone_no }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="border-bottom pb-1">Payment Type</h6>
                <p class="mb-1">{{ strtoupper($order->payment_type) }}</p>
            </div>
        </div>

        <!-- Address Info -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="border-bottom pb-1">Billing Address</h6>
                <p class="mb-1">{{ $billing_address?->address }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="border-bottom pb-1">Delivery Address</h6>
                <p class="mb-1">{{ $delivery_address?->address }}</p>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="mb-4">
            <h6 class="border-bottom pb-2">Order Items</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Variant</th>
                            <th class="text-end">Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderChild as $child)
                            @php
                                $product = $child?->product;
                                $variant = $product?->ProductVariants()->where('id', $child->product_variant_id)->first();
                                $price = $variant?->product_variant_price ?? $product?->product_price;
                                $sku = $variant?->product_variant_skucode ?? $product?->product_sku_code;
                                $qty = $child->qty;
                                $total = $price * $qty;
                                $variantCombo = $variant ? implode('/', $variant?->variant_combination ?? []) : '--';
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $product?->product_name }}</strong><br>
                                    <small class="text-muted">SKU: {{ $sku }}</small>
                                </td>
                                <td>{{ $variantCombo }}</td>
                                <td class="text-end">&#8377;{{ number_format($price, 2) }}</td>
                                <td class="text-center">{{ $qty }}</td>
                                <td class="text-end">&#8377;{{ number_format($total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="row justify-content-end">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Subtotal ({{ $orderChild->sum('qty') }} items)</th>
                        <td class="text-end">&#8377;{{ number_format($order->sub_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Shipping</th>
                        <td class="text-end">&#8377;0.00</td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td class="text-end">&#8377;{{ number_format($order->tax_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-success">Discount</th>
                        <td class="text-end text-success">-&#8377;{{ number_format($order->discount_amount, 2) }}</td>
                    </tr>
                    <tr class="fw-bold border-top">
                        <th>Total Amount</th>
                        <td class="text-end text-primary">&#8377;{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-5 text-muted small">
            Thank you for your order!<br>
            <em>This is a system-generated invoice.</em>
        </div>
    </div>

    <!-- Auto Print -->
    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>

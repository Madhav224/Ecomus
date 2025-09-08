<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->order_number }}</title>
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 30px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .heading {
            font-weight: bold;
            font-size: 20px;
        }

        .text-sm {
            font-size: 13px;
        }

        .border-top {
            border-top: 1px solid #ddd !important;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">
    <div class="row mb-4">
        <div class="col-6">
            <h2 class="mb-1">Invoice</h2>
            <p class="mb-0"><strong>Order #:</strong> {{ $order->order_number }}</p>
            <p class="mb-0"><strong>Status:</strong> {{ $order->OrderStatus?->orderstatus_name }}</p>
        </div>
        <div class="col-6 text-end">
            <h5 class="mb-0">E-commerce</h5>
            <small>{{ config('app.email', 'support@ecommerce.com') }}</small>
        </div>
    </div>

    <hr>

    <div class="row mb-3">
        <div class="col-md-6">
            <h6 class="border-bottom pb-1">Customer Info</h6>
            <p class="mb-0">{{ $user?->name }}</p>
            <p class="mb-0">{{ $user?->email }}</p>
            <p class="mb-0">+91 {{ $user?->phone_no }}</p>
            <p class="mb-0"><strong>Payment Type:</strong> {{ strtoupper($order->payment_type) }}</p>
        </div>
        <div class="col-md-6">
            <h6 class="border-bottom pb-1">Billing Address</h6>
            <p class="mb-0">{{ $billing_address?->address }}</p>
            <h6 class="border-bottom pb-1 mt-3">Delivery Address</h6>
            <p class="mb-0">{{ $delivery_address?->address }}</p>
        </div>
    </div>

    <h6 class="border-bottom pb-1 mb-2">Order Items</h6>
    <table class="table table-bordered table-sm">
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
                $product = $child->product;
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
                    <small>SKU: {{ $sku }}</small>
                </td>
                <td>{{ $variantCombo }}</td>
                <td class="text-end">&#8377;{{ number_format($price, 2) }}</td>
                <td class="text-center">{{ $qty }}</td>
                <td class="text-end">&#8377;{{ number_format($total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row justify-content-end">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th class="text-start">Subtotal ({{ $orderChild->sum('qty') }} items)</th>
                    <td class="text-end">&#8377;{{ number_format($order->sub_amount, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-start">Shipping</th>
                    <td class="text-end">&#8377;0.00</td>
                </tr>
                <tr>
                    <th class="text-start">Tax</th>
                    <td class="text-end">&#8377;{{ number_format($order->tax_amount, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-start text-success">Discount</th>
                    <td class="text-end text-success">-&#8377;{{ number_format($order->discount_amount, 2) }}</td>
                </tr>
                <tr class="fw-bold border-top">
                    <th class="text-start">Total Amount</th>
                    <td class="text-end text-primary">&#8377;{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <p class="text-center mt-5 text-muted small">
        Thank you for your order!<br>
        This is a system-generated invoice.
    </p>
</div>

</body>
</html>

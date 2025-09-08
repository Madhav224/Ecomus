@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
    <style>
        <style>.avatar {
            width: 40px;
            height: 40px;
            display: inline-flex;
        }

        .address-card {
            transition: all 0.3s ease;
        }

        .address-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .timeline {
            position: relative;
            padding-left: 1rem;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
            padding-left: 1.5rem;
            border-left: 1px solid #dee2e6;
        }

        .timeline-item:last-child {
            border-left: 1px solid transparent;
        }

        .timeline-point {
            position: absolute;
            left: -7px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #0d6efd;
            border: 2px solid white;
        }

        .timeline-content {
            padding-left: 0.5rem;
        }

        .sticky-top {
            z-index: 1;
        }
    </style>
    </style>
@endsection
@section('content')
    <section class="app-orderdetails-list">

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ $order?->order_number }}</h4>
                        <span class="badge bg-light text-primary">{{ $order?->OrderStatus?->orderstatus_name }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="fw-bolder border-bottom pb-50 mb-1">User Details</h4>
                                <div class="flex-grow-1 ">
                                    <h5 class="mb-1">{{ $user?->name }}</h5>
                                    <h6 class="mb-1">{{ $user?->email }}</h6>
                                    <h6 class="mb-5">+91 {{ $user?->phone_no }}</h6>
                                </div>
                                <h5 class="fw-bolder border-bottom pb-50 mb-1">Payment Type</h5>
                                <h6 class="mb-1">{{ strtoupper($order?->payment_type) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Delivery Address</h4>
                                        <h6>{{ $delivery_address?->address }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Billing Address</h4>

                                        <h6>{{ $billing_address?->address }}</h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card shadow-sm">
                    <div class="card-header  text-white">
                        <h4 class="card-title mb-0">Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-2">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                <span class="text-muted">Subtotal ({{$orderChild->sum('qty')}} items)</span>
                                <span>&#x20B9;{{ $order?->sub_amount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                <span class="text-muted">Shipping</span>
                                <span>&#x20B9;0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                <span class="text-muted">Tax (0%)</span>
                                <span>&#x20B9;{{ $order?->tax_amount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                                <span class="text-muted">Discount</span>
                                <span class="text-success">- &#x20B9;{{ $order?->discount_amount }}</span>
                            </li>
                        </ul>

                        <div class="d-flex justify-content-between align-items-center fw-bold fs-5 border-top pt-2 mb-2">
                            <span>Total Amount</span>
                            <span class="text-primary">&#x20B9;{{ $order?->total_amount }}</span>
                        </div>

                        <div class="order-actions">
                            <a href="{{route('orders.print',encrypt_to($order?->id))}}" target="_blank" class="btn btn-primary w-100  d-flex align-items-center justify-content-center">
                                <i class="fas fa-print me-2"></i>Print Invoice
                            </a>

                            {{-- <button
                                class="btn btn-outline-secondary w-100 mb-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-envelope me-2"></i>Email Invoice
                            </button>
                            <button class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-times me-2"></i>Cancel Order
                            </button> --}}

                        </div>
                        {{-- <div class="order-timeline mt-4">
                            <h6 class="text-muted mb-3">Order Timeline</h6>
                            <ul class="timeline">
                                <li class="timeline-item">
                                    <span class="timeline-point"></span>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Order Placed</h6>
                                        <p class="text-muted mb-0">Today, 10:30 AM</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point"></span>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Payment Pending</h6>
                                        <p class="text-muted mb-0">COD - To be collected</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point"></span>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Processing</h6>
                                        <p class="text-muted mb-0">Expected dispatch in 24 hours</p>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="fw-bolder border-bottom pb-50 mb-1">Order Items</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th>Product</th>
                                <th>Variant</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($orderChild)}} --}}
                            @foreach ($orderChild as $index => $child)
                                <?php
                                $product = $child?->product;
                                $productVariant = $product?->ProductVariants()->where('id', $child?->product_variant_id)->where('product_id', $child?->product_id)->first();

                                $image = $productVariant?->product_variant_thumbnail_image_url ?? $product?->product_thumbnail_image_url;

                                $price = $productVariant?->product_variant_price ?? $product?->product_price;
                                $sku = $productVariant?->product_variant_skucode ?? $product?->product_sku_code;

                                $qty = $child->qty;
                                $total = $price * $qty;
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $image }}" alt="Product" class="img-thumbnail me-3"
                                                width="50">
                                            <div>
                                                <h6 class="mb-0">{{ $product->product_name }}</h6>
                                                <small class="text-muted">SKU: {{ $sku }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $productVariant ? implode('/', $productVariant?->variant_combination) : '--' }}
                                    </td>
                                    <td>&#8377;{{ $price }}</td>
                                    <td>{{ $qty }}</td>
                                    <td>&#8377;{{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>





    </section>
@endsection



@section('vendor-script')

    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                })
            }
            $('.select2').select2({
                // dropdownAutoWidth: true,
                minimumResultsForSearch: 0
            });
        });
    </script>



@endsection

@extends('frontend.layout.layout')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Cart</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5">
                    @if (session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif

                    @if (session()->get('error'))
                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                    @endif
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12 site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($cartItem)
                                @foreach ($cartItem as $key => $cart)
                                    <tr class="orderItem" data-id="{{ $key }}">
                                        <td class="product-thumbnail">
                                            <img src="{{ asset($cart['image']) }}" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $cart['name'] ?? '' }}</h2>
                                        </td>
                                        <td>$ {{ $cart['price'] }}</td>
                                        <td>
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="decreaseBtn btn btn-outline-primary js-btn-minus"
                                                        type="button">&minus;</button>
                                                </div>
                                                <input type="text" class="qtyItem form-control text-center"
                                                    value="{{ $cart['qty'] }}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                                <div class="input-group-append">
                                                    <button class="increaseBtn btn btn-outline-primary js-btn-plus"
                                                        type="button">&plus;</button>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="itemTotal">$ {{ $cart['price'] * $cart['qty'] }}</td>
                                        <td>
                                            <form action="{{ route('cartremove') }}" method="POST">
                                                @csrf
                                                <input type="text" hidden name="product_id" value="{{ $key }}">
                                                <button type="submit" class="btn btn-primary btn-sm">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('coupon.check') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" name="coupon_name"
                                    value="{{ session()->get('couponCode') ?? '' }}" id="coupon"
                                    placeholder="Coupon Code">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$230.00</strong>
                                </div>
                            </div> --}}
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$ {{session()->get('totalPrice') ?? ''}}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="paymentButton btn btn-primary btn-lg py-3 btn-block">Proceed To
                                        Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        $(document).on('click', '.paymentButton', function(e) {
            var url = "{{ route('cart.form') }}";

            @if (!empty(session()->get('cart')))
                window.location.href = url;
            @endif

        });

        $(document).on('click', '.decreaseBtn', function(e) {
            $('.orderItem').removeClass('selected');
            $(this).closest('.orderItem').addClass('selected');
            sepetUpdate();
        });

        $(document).on('click', '.increaseBtn', function(e) {
            $('.orderItem').removeClass('selected');
            $(this).closest('.orderItem').addClass('selected');
            sepetUpdate();
        });

        function sepetUpdate() {
            var product_id = $('.selected').closest('.orderItem').attr('data-id');
            var qty = $('.selected').closest('.orderItem').find('.qtyItem').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('cartnewQty') }}",
                data: {
                    product_id: product_id,
                    qty: qty,
                },
                success: function(response) {
                    $('.selected').find('.itemTotal').text('$' + response.itemTotal);
                    if (qty == 0) {
                        $('.selected').remove();
                    }
                    $('.newTotalPrice').text(response.totalPrice);
                }
            });
        }
    </script>
@endsection

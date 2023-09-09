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
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('cart.save') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group">
                                <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                <select id="c_country" name="country" class="form-control">
                                    <option value="">Select a country</option>
                                    <option value="Turkey" selected>Türkiye</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Name Surname<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Company Name </label>
                                    <input type="text" class="form-control" id="c_companyname" name="company_name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="address"
                                        placeholder="Street address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">City<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="city">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">District<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="district">
                                </div>
                                <div class="col-md-12">
                                    <label for="c_postal_zip" class="text-black">Posta / Zip <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_postal_zip" name="zip_code">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="phone"
                                        placeholder="Phone Number">
                                </div>
                            </div>

                            {{-- <div class="form-group">
                            <label for="c_create_account" class="text-black" data-toggle="collapse"
                                href="#create_an_account" role="button" aria-expanded="false"
                                aria-controls="create_an_account"><input type="checkbox" value="1"
                                    id="c_create_account"> Create an account?</label>
                            <div class="collapse" id="create_an_account">
                                <div class="py-2">
                                    <p class="mb-3">Create an account by entering the information below. If you are a
                                        returning customer please login at the top of the page.</p>
                                    <div class="form-group">
                                        <label for="c_account_password" class="text-black">Account Password</label>
                                        <input type="email" class="form-control" id="c_account_password"
                                            name="c_account_password" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Order Notes</label>
                                <textarea name="note" id="c_order_notes" cols="30" rows="5" class="form-control"
                                    placeholder="Write your notes here..."></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                                <div class="p-3 p-lg-5 border">

                                    <label for="c_code" class="text-black mb-3">Enter your coupon code if you have
                                        one</label>
                                    <div class="input-group w-75">
                                        <input type="text" class="form-control" id="c_code"
                                            placeholder="Coupon Code" value="{{ session()->get('couponCode') ?? '' }}"
                                            aria-label="Coupon Code" aria-describedby="button-addon2" readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Your Order</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>

                                            @if (session()->get('cart'))
                                                @foreach (session()->get('cart') as $key => $cart)
                                                    @php
                                                        $kdvOrani = $cart['kdv'] ?? 0;
                                                        $price = $cart['price'];
                                                        $qty = $cart['qty'];

                                                        $kdvTutar = $price * $qty * ($kdvOrani / 100);
                                                        $toplamTutar = $price * $qty + $kdvTutar;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $cart['name'] }} <strong class="mx-2">x</strong>
                                                            {{ $cart['qty'] }}</td>
                                                        <td>$ {{ $toplamTutar }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            {{-- <tr>
                                                <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                                <td class="text-black">$350.00</td>
                                            </tr> --}}
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Coupon Price</strong></td>
                                                <td class="text-black font-weight-bold"><strong>$
                                                        {{ session()->get('couponPrice') ?? 0 }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                <td class="text-black font-weight-bold"><strong>$
                                                        {{ session()->get('totalPrice') ?? 0 }}</strong></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse"
                                                href="#collapsebank" role="button" aria-expanded="false"
                                                aria-controls="collapsebank">Direct Bank
                                                Transfer</a></h3>

                                        <div class="collapse" id="collapsebank">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please
                                                    use
                                                    your Order ID as the payment reference. Your order won’t be shipped
                                                    until
                                                    the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse"
                                                href="#collapsecheque" role="button" aria-expanded="false"
                                                aria-controls="collapsecheque">Cheque
                                                Payment</a></h3>

                                        <div class="collapse" id="collapsecheque">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please
                                                    use
                                                    your Order ID as the payment reference. Your order won’t be shipped
                                                    until
                                                    the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-5">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse"
                                                href="#collapsepaypal" role="button" aria-expanded="false"
                                                aria-controls="collapsepaypal">Paypal</a></h3>

                                        <div class="collapse" id="collapsepaypal">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please
                                                    use
                                                    your Order ID as the payment reference. Your order won’t be shipped
                                                    until
                                                    the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-lg py-3 btn-block">Place Order</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- </form> -->
        </div>
    </div>
@endsection

@extends('backend.layout.app')

@section('customcss')
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
            font-family: system-ui;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        .center {
            text-align: center;
        }

        h2 {
            font-size: 36px;
            font-weight: 500;
        }

        .header-img {
            width: 100px;
            height: 100px;
        }

        .invoice {
            display: flex;
            justify-content: space-between;
        }

        .invoice-header {
            font-size: 24px;
        }

        .font-size-14 {
            font-size: 14px;
            line-height: 4px;
        }

        .bold-text {
            font-weight: 800;
        }

        table.unstyledTable {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0 5px;
            table-layout: fixed;
        }

        thead tr th {
            border-bottom: 2px solid #DCDCDC;
            font-weight: 800;
        }

        tbody tr {
            border-bottom: 1px solid #DCDCDC;
            text-align: end;
        }

        tbody tr td {
            padding: 8px;
        }

        .last-row {
            border: 0;
        }

        .footer {
            text-align: end;
        }

        .font-weight-400 {
            font-weight: 400;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order</h4>

                    @if ($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>

                <div class="page">
                    <div class="subpage">
                        <div class="header center"><img class="header-img" src="{{ asset($settings['logo']) }}" />
                            <h2 class="font-weight-400">{{ $order->name ?? '' }}</h2>
                        </div>

                        <div class="invoice">
                            <div class="invoce-from">
                                <p class="invoice-header">Order No</p>
                                <div class="font-size-14">
                                    <p>{{ isset($order->order_no) ?? '' }}</p>
                                </div>
                            </div>
                            <div class="font-size-14">
                                {{-- <p class="bold-text">Order date:
                                    {{ isset($order->created_at) ? Carbon::parse($order->created_at)->format('d-m-Y H:i:s') : '' }}
                                </p> --}}
                                <p class="bold-text">Order date:
                                    {{ isset($order->created_at) ? Carbon::parse($order->created_at)->format('d.m.Y H:i') : '' }}
                                </p>
                                <p>Confirmation Time:
                                    {{ isset($order->updated_at) ? Carbon::parse($order->updated_at)->format('d.m.Y H:i') : '' }}
                                </p>
                            </div>
                        </div>
                        <div class="invoice">
                            <div class="invoce-from">
                                <div class="font-size-14">
                                </div>
                            </div>
                            <div class="font-size-14">
                                <p>{{ $order->phone }}</p>
                                <p>{{ $order->address }}</p>
                                <p>{{ $order->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <h2 class="center font-weight-400">Invoice Information</h2>
                        <p class="font-size-14">{{ $order->company_name ?? '' }}</p>
                        <p class="font-size-14">{{ $order->country }}</p>
                        <p class="font-size-14">{{ $order->city }}</p>
                        <p class="font-size-14">{{ $order->district }}</p>
                        <p class="font-size-14">{{ $order->note }}</p>

                        <table class="unstyledTable">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Rate of VAT</th>
                                    <th>Unit Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $allTotal = 0;
                                @endphp
                                @if (!empty($order->orders))
                                    @foreach ($order->orders as $item)
                                        @php
                                            $kdvOrani = $item['kdv'] ?? 0;
                                            $price = $item['price'];
                                            $qty = $item['qty'];

                                            $kdvTutar = $price * $qty * ($kdvOrani / 100);
                                            $toplamTutar = $price * $qty + $kdvTutar;
                                        @endphp
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['qty'] }}</td>
                                            <td>{{ $item['price'] }}</td>
                                            <td>{{ $item['kdv'] }}</td>
                                            <td>${{ $toplamTutar }}</td>
                                            @php
                                                $allTotal += $toplamTutar;
                                            @endphp
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            </tr>
                        </table>

                        <div class="footer">
                            <h2 class="font-weight-400">Total : $ {{ $allTotal }}
                                <h2 />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name Surname</th>
                                    <th>Emailt</th>
                                    <th>Phonet</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Number of Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($orders) && $orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr class="item" item-id="{{ $order->id }}">
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email ?? '' }}</td>
                                            <td>{{ $order->phone ?? '' }}</td>
                                            <td>{!! strLimit($order->address, 20, route('panel.order.edit', $order->id)) !!}</td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="durum" data-on="Active"
                                                            data-off="Passive" data-onstyle="success" data-offstyle="danger"
                                                            data-toggle="toggle"
                                                            {{ $order->status == '1' ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $order->orders_count ?? '' }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('panel.order.edit', $order->id) }}"
                                                    class="btn btn-primary mr-2">Edit
                                                </a>
                                                <button type="button" class="deleteBtn btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            {{ $orders->links('pagination::custom') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        // basmalı olduğu için change kullanıldı
        // buton olsaydı click kullanılması gerekiyordu
        $(document).on('change', '.durum', function(e) {
            // alert('test')
            id = $(this).closest('.item').attr('item-id');
            statu = $(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('panel.order.status') }}",
                data: {
                    id: id,
                    statu: statu
                },
                success: function(response) {
                    if (response.status == 'true') {
                        alertify.success("Status activated")
                    } else {
                        alertify.error('Status deactivated')
                    }
                }
            });
        });

        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var item = $(this).closest('.item');
            id = item.attr('item-id');

            alertify.confirm("Are you sure?", "You won't be able to revert this!",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.order.destroy') }}",
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.error == false) {
                                item.remove();
                                alertify.success(response.message)
                            } else {
                                alertify.error("Something went wrong");
                            }
                        }
                    });
                },
                function() {
                    alertify.error('Deletion canceled.');
                });
        });
    </script>
@endsection

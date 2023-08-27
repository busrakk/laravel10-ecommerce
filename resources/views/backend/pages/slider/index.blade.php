@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.slider.create') }}" class="btn btn-primary">Add</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($sliders) && $sliders->count() > 0)
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{ asset($slider->image) }}" alt="{{ $slider->name }}" />
                                            </td>
                                            <td>{{ $slider->name }}</td>
                                            <td>{{ $slider->content ?? '' }}</td>
                                            <td>{{ $slider->link }}</td>
                                            <td><label
                                                    class="badge badge-{{ $slider->status == '1' ? 'success' : 'danger' }}">
                                                    {{ $slider->status == '1' ? 'Active' : 'Passive' }}
                                                </label></td>
                                            <td class="d-flex">
                                                <a href="{{ route('panel.slider.edit', $slider->id) }}"
                                                    class="btn btn-primary mr-2">Edit
                                                </a>
                                                <form action="{{ route('panel.slider.destroy', $slider->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

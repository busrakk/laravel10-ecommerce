@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category</h4>

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

                    @if (!empty($category->id))
                        @php
                            $routeLink = route('panel.category.update', $category->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.category.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($category->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <img src="{{ asset($category->image ?? 'img/noimage.webp') }}" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $category->name ?? '' }}"
                                name="name" placeholder="category Title">
                        </div>
                        <div class="form-group">
                            <label for="content">Kategori</label>
                            <select class="form-control" name="cat_ust" id="">
                                <option value="">Select Category</option>
                                @if ($categories)
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($category) && $category->cat_ust == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" rows="4" name="content" placeholder="Category Content">
                                {!! $category->content ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $category->status ?? '1';
                            @endphp
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $status == '0' ? 'selected' : '' }}>Passive</option>
                                <option value="1" {{ $status == '1' ? 'selected' : '' }}>Active</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

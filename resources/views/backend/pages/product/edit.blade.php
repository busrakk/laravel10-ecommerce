@extends('backend.layout.app')

@section('customcss')
    <style>
        .ck-content {
            height: 300px !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product</h4>

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

                    @if (!empty($product->id))
                        @php
                            $routeLink = route('panel.product.update', $product->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.product.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($product->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <img src="{{ asset($product->image ?? 'img/noimage.webp') }}" alt="">
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
                            <input type="text" class="form-control" id="name" value="{{ $product->name ?? '' }}"
                                name="name" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label for="content">Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">Select Category</option>
                                @if ($categories)
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="editor" rows="4" name="content" placeholder="Product Content">
                                {!! $product->content ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="short_text">Short Text</label>
                            <input type="text" class="form-control" id="short_text"
                                value="{{ $product->short_text ?? '' }}" name="short_text" placeholder="Short Text">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" value="{{ $product->price ?? '' }}"
                                name="price" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="size">Product Size</label>
                            <select class="form-control" id="size" name="size">
                                <option value="">Select Size</option>
                                <option value="XS"
                                    {{ isset($product->size) && $product->size == 'XS' ? 'selected' : '' }}>XS</option>
                                <option value="S"
                                    {{ isset($product->size) && $product->size == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M"
                                    {{ isset($product->size) && $product->size == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L"
                                    {{ isset($product->size) && $product->size == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL"
                                    {{ isset($product->size) && $product->size == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="XXL"
                                    {{ isset($product->size) && $product->size == 'XXL' ? 'selected' : '' }}>XXL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" id="color" value="{{ $product->color ?? '' }}"
                                name="color" placeholder="Color">
                        </div>
                        <div class="form-group">
                            <label for="qty">Product Quantity</label>
                            <input type="text" class="form-control" id="qty" value="{{ $product->qty ?? '' }}"
                                name="qty" placeholder="Product Quantity">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $product->status ?? '1';
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

@section('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/translations/tr.js"></script> // dili tr olsun --}}

    <script>
        const option = {
            // language: 'tr',
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
        }

        ClassicEditor
            .create(document.querySelector('#editor'), option)
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

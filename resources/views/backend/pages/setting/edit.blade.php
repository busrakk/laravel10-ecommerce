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
                    <h4 class="card-title">Site Setting</h4>

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

                    @if (!empty($setting->id))
                        @php
                            $routeLink = route('panel.setting.update', $setting->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.setting.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($setting->id))
                            @method('PUT')
                        @endif

                        <select name="set_type" class="form-control">
                            <option value="">
                                Select Type
                            </option>
                            <option value="ckeditor"
                                {{ isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : '' }}>
                                Ckeditor
                            </option>
                            <option value="textarea"
                                {{ isset($setting->set_type) && $setting->set_type == 'textarea' ? 'selected' : '' }}>
                                Textarea
                            </option>
                            <option value="file"
                                {{ isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : '' }}>File
                            </option>
                            <option value="image"
                                {{ isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : '' }}>Image
                            </option>
                            <option value="text"
                                {{ isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : '' }}>Text
                            </option>
                            <option value="email"
                                {{ isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : '' }}>Email
                            </option>
                        </select>

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                @if (isset($setting->set_type) && $setting->set_type == 'image')
                                    <img src="{{ asset($setting->data ?? 'img/noimage.webp') }}" alt="">
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" class="form-control" id="name" value="{{ $setting->name ?? '' }}"
                                name="name" placeholder="Key">
                        </div>
                        <div class="form-group">
                            <label for="data">Value</label>

                            <div class="inputContent">
                                @if (isset($setting->set_type) && $setting->set_type == 'ckeditor')
                                    <textarea class="form-control" id="editor" rows="4" name="data" placeholder="Value">
                                    {!! $setting->data ?? '' !!}
                                </textarea>
                                @elseif (isset($setting->set_type) && $setting->set_type == 'textarea')
                                    <textarea class="form-control" id="data" rows="4" name="data" placeholder="Value">
                                    {!! $setting->data ?? '' !!}
                                </textarea>
                                @elseif (
                                    (isset($setting->set_type) && $setting->set_type == 'image') ||
                                        (isset($setting->set_type) && $setting->set_type == 'file'))
                                    <input type="file" name="data" value="{{ $setting->data ?? '' }}"
                                        class="form-control">
                                @elseif (isset($setting->set_type) && $setting->set_type == 'text')
                                    <input type="text" name="data" value="{{ $setting->data ?? '' }}"
                                        class="form-control" placeholder="Text">
                                @elseif (isset($setting->set_type) && $setting->set_type == 'email')
                                    <input type="email" name="data" value="{{ $setting->data ?? '' }}"
                                        class="form-control" placeholder="Email">
                                @else
                                @endif
                            </div>
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

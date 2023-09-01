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
                    <h4 class="card-title">About</h4>

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

                    <form class="forms-sample" action="{{ route('panel.about.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <img src="{{ asset($about->image ?? 'img/noimage.webp') }}" alt="" class="w-100">
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
                            <input type="text" class="form-control" id="name" value="{{ $about->name ?? '' }}"
                                name="name" placeholder="About Title">
                        </div>
                        <div class="form-group">
                            <label for="editor">Content</label>
                            <textarea class="form-control" id="editor" rows="4" name="content" placeholder="About Content">
                                {!! $about->content ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="text_1_icon">Icon 1</label>
                            <input type="text" class="form-control" id="text_1_icon" name="text_1_icon"
                                value="{{ $about->text_1_icon ?? '' }}" placeholder="Text Icon 1">
                        </div>
                        <div class="form-group">
                            <label for="text_1">Text 1</label>
                            <input type="text" class="form-control" id="text_1" name="text_1"
                                value="{{ $about->text_1 ?? '' }}" placeholder="Text 1">
                        </div>
                        <div class="form-group">
                            <label for="editor">Text 1 Content</label>
                            <textarea class="form-control" id="text_1_content" rows="4" name="text_1_content" placeholder="Text 1 Content">
                                {!! $about->text_1_content ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="text_2_icon">Icon 2</label>
                            <input type="text" class="form-control" id="text_2_icon" name="text_2_icon"
                                value="{{ $about->text_2_icon ?? '' }}" placeholder="Text Icon 2">
                        </div>
                        <div class="form-group">
                            <label for="text_2">Text 2</label>
                            <input type="text" class="form-control" id="text_2" name="text_2"
                                value="{{ $about->text_2 ?? '' }}" placeholder="Text 2">
                        </div>
                        <div class="form-group">
                            <label for="editor">Text 2 Content</label>
                            <textarea class="form-control" id="text_2_content" rows="4" name="text_2_content" placeholder="Text 2 Content">
                                {!! $about->text_2_content ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="text_3_icon">Icon 3</label>
                            <input type="text" class="form-control" id="text_3_icon" name="text_3_icon"
                                value="{{ $about->text_3_icon ?? '' }}" placeholder="Text Icon 3">
                        </div>
                        <div class="form-group">
                            <label for="text_3">Text 3</label>
                            <input type="text" class="form-control" id="text_3" name="text_3"
                                value="{{ $about->text_3 ?? '' }}" placeholder="Text 3">
                        </div>
                        <div class="form-group">
                            <label for="editor">Text 3 Content</label>
                            <textarea class="form-control" id="text_3_content" rows="4" name="text_3_content"
                                placeholder="Text 3 Content">
                                {!! $about->text_3_content ?? '' !!}
                            </textarea>
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

@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Contact</h4>

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

                    <form class="forms-sample" action="{{ route('panel.contact.update', $contact->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name Surname</label>
                            <input type="text" class="form-control" readonly id="name"
                                value="{{ $contact->name ?? '' }}" placeholder="Name Surname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" readonly id="email"
                                value="{{ $contact->email ?? '' }}" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="link">Subject</label>
                            <input type="text" class="form-control" readonly id="subject"
                                value="{{ $contact->subject ?? '' }}" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" readonly id="message" rows="4" name="message" placeholder="Message">
                                {!! $contact->message ?? '' !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $contact->status ?? '1';
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

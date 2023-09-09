<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('index') }}">Home</a>
                @if (!empty($breadcrumb['pages']))
                    @foreach ($breadcrumb['pages'] as $br)
                        <span class="mx-2 mb-0">/</span>
                        <a href="{{ $br['link'] }}">{{ $br['name'] }}</a>
                    @endforeach
                @endif
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">{{ $breadcrumb['active'] }}</strong>
            </div>
        </div>
    </div>
</div>

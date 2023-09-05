@extends('frontend.layout.layout')

@section('content')
    @if (!empty($slider))
        <div class="site-blocks-cover" style="background-image: url({{ asset($slider->image ?? '') }});" data-aos="fade">
            <div class="container">
                <div class="row align-items-start align-items-md-center justify-content-end">
                    <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                        <h1 class="mb-2">{{ $slider->name ?? __('Welcome') }}</h1>
                        <div class="intro-text text-center text-md-left">
                            <p class="mb-4">{{ $slider->content ?? __('') }}</p>
                            <p>
                                <a href="{{ $slider->link ?? '' }}" class="btn btn-sm btn-primary">Shop Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                    <div class="icon mr-4 align-self-start">
                        <span class="{{ $about->text_1_icon }}"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">{{ $about->text_1 }}</h2>
                        <p>{{ $about->text_1_content }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon mr-4 align-self-start">
                        <span class="{{ $about->text_2_icon }}"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">{{ $about->text_2 }}</h2>
                        <p>{{ $about->text_2_content }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon mr-4 align-self-start">
                        <span class="{{ $about->text_3_icon }}"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">{{ $about->text_3 }}</h2>
                        <p>{{ $about->text_3_content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-blocks-2">
        <div class="container">
            <div class="row">
                @if (!empty($categories) && $categories->count() > 0)
                    @foreach ($categories->where('cat_ust', null) as $category)
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item" href="{{ url($category->slug) }}">
                                <figure class="image">
                                    <img src="{{ asset($category->image) }}" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <h3>{{ $category->name }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        @if (!empty($lastProducts) && $lastProducts->count() > 0)
                            @foreach ($lastProducts as $item)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <img src="{{ asset($item->image) }}" alt="Image placeholder" class="img-fluid">
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="#">{{ $item->name }}</a></h3>
                                            <p class="mb-0">{{ $item->category->name ?? '' }}</p>
                                            <p class="text-primary font-weight-bold">$ {{ $item->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-8">
        <div class="container">
            <div class="row justify-content-center  mb-5">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Big Sale!</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 mb-5">
                    <a href="#"><img src="{{ $settings['campaign_image'] ?? '' }}" alt="Image placeholder"
                            class="img-fluid rounded"></a>
                </div>
                <div class="col-md-12 col-lg-5 text-center pl-md-5">
                    <h4>
                        <a href="#">{{ $settings['campaign_title'] ?? '' }}</a>
                    </h4>
                    <p>{!! $settings['campaign_text'] ?? '' !!}</p>
                    <p><a href="{{ route('sale-product') }}" class="btn btn-primary btn-sm">Shop Now</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

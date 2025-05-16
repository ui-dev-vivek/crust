<div class="hero-wrapper">
    <div class="container">
        <div class="pt-3">
            <!-- Hero Slides-->
            <div class="hero-slides owl-carousel">
                <!-- Single Hero Slide-->
                @foreach ($this->CarouselItems as $item)
                    <div class="single-hero-slide" style="background-image: url('{{ Storage::url($item->image) }}');">
                        <div class="slide-content h-100 d-flex align-items-center">
                            <div class="slide-text">
                                <h4 class="mb-0 text-white" data-animation="fadeInUp" data-delay="100ms" data-duration="1000ms">{{ $item->title }}</h4>
                                <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-duration="1000ms">Mava Fashion</p>
                                <a class="text-white btn btn-primary" href="{{ $item->btn_link }}" data-animation="fadeInUp" data-delay="800ms" data-duration="1000ms">{{ $item->btn_lable }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


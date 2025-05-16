<style>
    .product-catagories-wrapper .col-2 .flex-column .text-center a {
        font-size: 12px;
        letter-spacing: -0.4px;
    }
    .product-catagories-wrapper .flex-column .d-flex {
        border-style: solid;
        border-color: #c745a2;
        border-width: 3px;
    }
</style>

<div class="py-3 product-catagories-wrapper">
    <div class="container">
        <div class="row g-2 rtl-flex-d-row-r">
            <!-- Catagory Card -->
            @foreach ($categories as $catagory)
                <div class="col-3 col-lg-2">
                    <div class="d-flex flex-column align-items-center">
                        <div class="p-3 bg-white rounded-circle d-flex justify-content-center align-items-center">
                            <a href="">
                                <img src="{{ $catagory->icon ? Storage::url($catagory->icon) : '' }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                        <div class="mt-1 text-center">
                            <a href="" class="text-decoration-none text-dark">{{ $catagory->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- Need To Add Logic for Sub Catagories --}}

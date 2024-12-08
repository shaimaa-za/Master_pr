@extends('layouts.master')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div style="width: 80%; margin: 8% auto 4%;">
        <div class="row">
            <!-- عرض صور المنتج -->
            <div class="col-md-6">
                <!-- السلايدر الرئيسي -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($product->images as $image)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="{{ $product->name }}" style="max-height: 400px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- الصور المصغرة -->
                <div class="mt-3 d-flex justify-content-center">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail me-2" style="width: 80px; height: 80px; cursor: pointer;" onclick="document.querySelector('#productCarousel .carousel-item.active').classList.remove('active'); document.querySelectorAll('#productCarousel .carousel-item')[{{ $loop->index }}].classList.add('active');">
                    @endforeach
                </div>
            </div>

            <!-- تفاصيل المنتج -->
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p class="text-muted">${{ $product->price }}</p>
                <p>{{ $product->description }}</p>

                <!-- عرض الصفات فقط إذا كانت موجودة -->
                @if($product->attributes->isNotEmpty())
                    <div class="mb-3">
                        @foreach($product->attributes as $attribute)
                            @if(!empty($attribute->pivot->value))
                                <div class="mb-2">
                                    <strong>{{ $attribute->name }}:</strong> {{ $attribute->pivot->value }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <!-- زر الإضافة إلى السلة -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3 d-flex align-items-center">
                        <label for="quantity" class="me-3"><strong>Quantity:</strong></label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" style="width: 80px;">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // وظيفة لجعل الصور المصغرة تتفاعل مع السلايدر
    document.querySelectorAll('.img-thumbnail').forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', () => {
            const carousel = document.querySelector('#productCarousel');
            const items = carousel.querySelectorAll('.carousel-item');

            // إزالة الفعالية الحالية من السلايدر
            items.forEach(item => item.classList.remove('active'));

            // إضافة الفعالية للصورة المختارة
            items[index].classList.add('active');
        });
    });
</script>

@endsection

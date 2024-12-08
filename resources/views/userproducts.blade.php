@extends('layouts.master')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div style="width: 95%; margin: 8% auto 4%;">
        <h1 class="text-center mb-4">Our Products</h1>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="categoryTabs" role="tablist">
            <!-- تبويبة All Products -->
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-all" 
                        data-bs-toggle="tab" data-bs-target="#content-all" 
                        type="button" role="tab" aria-controls="content-all" 
                        aria-selected="true">
                    All Products
                </button>
            </li>

            @foreach($categories as $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-{{ $category->id }}" 
                            data-bs-toggle="tab" data-bs-target="#content-{{ $category->id }}" 
                            type="button" role="tab" aria-controls="content-{{ $category->id }}" 
                            aria-selected="false">
                        {{ $category->name }}
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="categoryTabsContent">
            <!-- تبويبة All Products -->
            <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">
                <div class="row">
                    @foreach($allProducts as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <!-- Product Image -->
                                @php
                                    $primaryImage = $product->images->where('is_primary', true)->first();
                                @endphp
                                @if ($primaryImage)
                                    <div class="product-image" style="width: 100%; height: 200px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $primaryImage->image_url) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @else
                                    <p>No image available</p>
                                @endif

                                <!-- Product Details -->
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>

                                    <!-- View Button -->
                                    <a href="{{ route('userproducts.details', $product->id) }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- تبويبات الفئات -->
            @foreach($categories as $category)
                <div class="tab-pane fade" id="content-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                    <div class="row">
                        @foreach($category->products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <!-- Product Image -->
                                    @php
                                        $primaryImage = $product->images->where('is_primary', true)->first();
                                    @endphp
                                    @if ($primaryImage)
                                        <div class="product-image" style="width: 100%; height: 200px; overflow: hidden;">
                                            <img src="{{ asset('storage/' . $primaryImage->image_url) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @else
                                        <p>No image available</p>
                                    @endif

                                    <!-- Product Details -->
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                                        <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>

                                        <!-- View Button -->
                                        <a href="{{ route('userproducts.details', $product->id) }}" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection






@extends('layouts.app')

@section('title', 'Trang người dùng')

@section('content')

    <!-- Banner -->
    <div class="container mt-4">
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow" style="max-height: 300px; overflow: hidden;">
                <div class="carousel-item active">
                    <img src="{{ asset('images/banner1.png') }}" class="d-block w-100" alt="Banner 1"
                        style="object-fit: cover; height: 300px;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner2.png') }}" class="d-block w-100" alt="Banner 2"
                        style="object-fit: cover; height: 300px;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner3.png') }}" class="d-block w-100" alt="Banner 3"
                        style="object-fit: cover; height: 300px;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Hiển thị sản phẩm -->
    <div class="container" id="sanpham">
        <h2 class="my-4 text-center">Sản phẩm mới nhất</h2>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow product-card">
                        <a href="{{ route('client.products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                        </a>
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <h5 class="card-title">
                                <a href="{{ route('client.products.show', $product->id) }}">{{ $product->name }}</a>
                            </h5>
                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center">
                    <p>Không có sản phẩm nào để hiển thị.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection

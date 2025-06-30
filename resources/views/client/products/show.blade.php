@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row rounded p-4">
        <div class="col-md-5 text-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded border" style="width: 100%; max-height: 400px; object-fit: contain;">
        </div>

        <div class="col-md-7">
            <h2 class="mb-3 text-primary">{{ $product->name }}</h2>

            <h4 class="text-danger mb-3">
                <strong>Giá:</strong>
                {{ number_format($product->price, 0, ',', '.') }} VNĐ
            </h4>

            <p class="mb-2"><strong>Tồn kho:</strong> {{ $product->stock }}</p>

            <div class="mb-4">
                <strong>Mô tả:</strong>
                <p class="mt-1 text-muted">{{ $product->description }}</p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary btn-lg">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>
<hr class="my-5">

<h4 class="mb-4 text-center">Sản phẩm liên quan</h4>
<div class="row">
    @forelse($relatedProducts as $related)
        <div class="col-md-3 mb-4">
            <div class="card product-card h-100">
                <a href="{{ route('client.products.show', $related->id) }}">
                    <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top" alt="{{ $related->name }}" style="height: 220px; object-fit: cover;">
                </a>
                <div class="card-body text-center">
                    <h6 class="card-title mb-1">
                        <a href="{{ route('client.products.show', $related->id) }}">{{ $related->name }}</a>
                    </h6>
                    <p class="card-text text-danger">{{ number_format($related->price, 0, ',', '.') }} VNĐ</p>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">Không có sản phẩm liên quan.</p>
    @endforelse
</div>

@endsection

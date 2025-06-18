@extends('layouts.app')

@section('title', 'Danh mục: ' . $category->name)

@section('content')
<div class="container mt-4">
    <h2 class="my-4 text-center">{{ $category->name }}</h2>

    @if($products->count())
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>

    @else
        <p class="text-center">Không có sản phẩm trong danh mục này.</p>
    @endif
</div>
@endsection

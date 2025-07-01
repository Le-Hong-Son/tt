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
                        <!-- Ảnh sản phẩm (click vào dẫn đến chi tiết) -->
                        <a href="{{ route('client.products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                        </a>

                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <!-- Tên sản phẩm (click vào dẫn đến chi tiết) -->
                            <h5 class="card-title">
                                <a href="{{ route('client.products.show', $product->id) }}">{{ $product->name }}</a>
                            </h5>

                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>

                            <!-- Form thêm vào giỏ hàng -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Thêm vào giỏ hàng</button>
                            </form>
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

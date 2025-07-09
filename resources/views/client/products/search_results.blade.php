@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm')

@section('content')

    <div class="container py-5">
        <h3 class="mb-4 text-center">Kết quả tìm kiếm cho: <strong>{{ $keyword }}</strong></h3>

        @if ($products->count())
            <div class="row">
                @foreach ($products as $product)
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
                @endforeach
            </div>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center">
                {{ $products->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center">
                <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong>{{ $keyword }}</strong>".</p>
            </div>
        @endif
    </div>

@endsection

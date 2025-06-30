@foreach ($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card shadow-sm border-0">
            <a href="{{ route('client.products.show', $product->id) }}">
                <img src="{{ asset('uploads/products/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="card-img-top img-fluid"
                     style="height: 230px; object-fit: cover;">
            </a>
            <div class="card-body text-center d-flex flex-column justify-content-between">
                <h5 class="card-title">
                    <a href="{{ route('client.products.show', $product->id) }}"
                       class="text-decoration-none text-dark">
                        {{ $product->name }}
                    </a>
                </h5>
                <p class="card-text text-danger fw-bold">
                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                </p>
                <a href="{{ route('client.products.show', $product->id) }}" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="bi bi-eye"></i> Xem chi tiết
                </a>
            </div>
        </div>
    </div>
@endforeach

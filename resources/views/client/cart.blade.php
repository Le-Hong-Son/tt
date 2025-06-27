@extends('layouts.app')

@section('title', 'Giỏ hàng của bạn!')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Giỏ hàng</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (!empty($cart))
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $id => $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                        @endphp
                        <tr>
                            <td style="width: 100px">
                                <img src="{{ asset('storage/' . $item['image']) }}" width="80"
                                    alt="{{ $item['name'] }}">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                            <td style="width: 120px">
                                <input type="number" name="quantities[{{ $id }}]"
                                    value="{{ $item['quantity'] }}" min="1"
                                    class="form-control text-center quantity-input" data-id="{{ $id }}"
                                    data-price="{{ $item['price'] }}">
                            </td>
                            <td class="item-total" data-id="{{ $id }}">
                                {{ number_format($itemTotal, 0, ',', '.') }} VNĐ
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST"
                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                        <td colspan="2">
                            <strong id="cart-total">{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ url('/') }}" class="btn btn-secondary">← Tiếp tục mua hàng</a>
                <a href="{{ route('cart.checkout.form') }}" class="btn btn-success">Đặt hàng</a>
            </div>

        @else
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="{{ url('/') }}" class="btn btn-outline-primary">Quay lại trang sản phẩm</a>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formatter = new Intl.NumberFormat('vi-VN');

            function updateCartTotal() {
                let total = 0;
                document.querySelectorAll('.quantity-input').forEach(input => {
                    const id = input.dataset.id;
                    const price = parseFloat(input.dataset.price);
                    const quantity = parseInt(input.value) || 1;

                    const itemTotal = price * quantity;
                    total += itemTotal;

                    // Cập nhật tổng từng sản phẩm
                    const itemTotalElement = document.querySelector('.item-total[data-id="' + id + '"]');
                    if (itemTotalElement) {
                        itemTotalElement.innerText = formatter.format(itemTotal) + ' VNĐ';
                    }
                });

                // Cập nhật tổng giỏ hàng
                document.getElementById('cart-total').innerText = formatter.format(total) + ' VNĐ';
            }

            // AJAX cập nhật số lượng
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const id = this.dataset.id;
                    const quantity = this.value;

                    fetch("{{ route('cart.update') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            quantities: { [id]: quantity }
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartTotal();
                        } else {
                            alert('Có lỗi xảy ra khi cập nhật số lượng!');
                        }
                    })
                    .catch(() => alert('Có lỗi xảy ra khi cập nhật số lượng!'));
                });
            });

            // Cập nhật tổng khi thay đổi số lượng (UI)
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', updateCartTotal);
            });
        });
    </script>
@endpush

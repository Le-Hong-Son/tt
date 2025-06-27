@extends('layouts.app')

@section('title', 'Thông tin đặt hàng')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Thanh toán đơn hàng</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf

        <div class="row">
            {{-- Form điền thông tin --}}
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">Thông tin khách hàng</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ giao hàng</label>
                            <textarea name="address" id="address" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="">-- Chọn phương thức --</option>
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="bank">Chuyển khoản ngân hàng</option>
                                {{-- <option value="vnpay">Thanh toán bằng VNPAY</option> --}}
                                {{-- <option value="momo">Ví điện tử Momo</option> --}}
                            </select>
                            <div id="payment-info" class="mt-2"></div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Tóm tắt đơn hàng --}}
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">Tóm tắt đơn hàng</div>
                    <div class="card-body">
                        <ul class="list-group mb-3">
                            @php $total = 0; @endphp
                            @foreach ($cart as $item)
                                @php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $total += $itemTotal;
                                @endphp
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                            width="60" class="me-3 rounded border">
                                        <div class="flex-grow-1">
                                            <div><strong>{{ $item['name'] }}</strong></div>
                                            <div>Số lượng: {{ $item['quantity'] }}</div>
                                        </div>
                                        <div class="text-end" style="min-width: 120px">
                                            {{ number_format($itemTotal, 0, ',', '.') }} VNĐ
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Tổng tiền</strong>
                                <strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Nút xác nhận --}}
        <div class="text-end">
            <button type="submit" class="btn btn-success px-4">Xác nhận đặt hàng</button>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">← Quay lại giỏ hàng</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethodSelect = document.getElementById('payment_method');
            const info = document.getElementById('payment-info');

            paymentMethodSelect.addEventListener('change', function () {
                const value = this.value;

                if (value === 'bank') {
                    info.innerHTML = '<p class="text-muted">Vui lòng chuyển khoản đến STK: <strong>123456789 - Ngân hàng ACB</strong></p>';
                } else if (value === 'momo') {
                    info.innerHTML = '<p class="text-muted">Vui lòng quét mã QR Momo bên dưới:</p><img src="/images/qr-momo.png" width="150">';
                } else {
                    info.innerHTML = '';
                }
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('title', 'Kết Quả Tra Cứu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow rounded-3">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Thông tin đơn hàng</h4>
                </div>
                <div class="card-body p-4">

                    <div class="mb-3">
                        <p><strong>Mã đơn hàng (ID):</strong> #{{ $order->id }}</p>
                        <p><strong>Họ tên:</strong> {{ $order->name }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                        <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                        <p><strong>Trạng thái:</strong>
                            @if($order->status === 'pending')
                                <span class="badge bg-warning">Chờ xác nhận</span>
                            @elseif($order->status === 'processing')
                                <span class="badge bg-primary">Đang xử lý</span>
                            @elseif($order->status === 'shipped')
                                <span class="badge bg-info">Đã giao hàng</span>
                            @elseif($order->status === 'cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @elseif($order->status === 'completed')
                                <span class="badge bg-success">Đã hoàn thành</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </p>
                        <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold">{{ number_format($order->total, 0, ',', '.') }}đ</span></p>
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <h5 class="mt-4">Chi tiết sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                                        <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('client.order.lookup.form') }}" class="btn btn-outline-primary">
                            🔄 Tra cứu đơn khác
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

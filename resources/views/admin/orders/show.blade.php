@extends('admin.layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Chi tiết đơn hàng #{{ $order->id }}</h3></div>
    <div class="card-body">
        <p><b>Tài khoản đặt hàng:</b> {{ $order->user->name ?? 'Ẩn' }}</p>
        <p><b>Email:</b> {{ $order->user->email ?? 'Ẩn' }}</p>
        <p><b>Người nhận hàng:</b> {{ $order->name }}</p>
        <p><b>SĐT người nhận:</b> {{ $order->phone }}</p>
        <p><b>Địa chỉ giao hàng:</b> {{ $order->address }}</p>
        <p><b>Trạng thái:</b>
            @switch($order->status)
                @case('pending')
                    Chờ xác nhận
                    @break
                @case('processing')
                    Đang xử lý
                    @break
                @case('shipped')
                    Đã giao
                    @break
                @case('cancelled')
                    Đã hủy
                    @break
                @default
                    Không xác định
            @endswitch
        </p>
        <p><b>PT Thanh toán:</b>
            @switch($order->payment_method)
                @case('cod') COD @break
                @case('bank') Chuyển khoản @break
                @case('vnpay') VNPAY @break
                @case('momo') Momo @break
                @default -
            @endswitch
        </p>
        <p><b>Tổng tiền:</b> {{ number_format($order->total) }}đ</p>
        <h5>Sản phẩm trong đơn:</h5>
        <table class="table table-bordered">
            <thead><tr><th>Tên sản phẩm</th><th>Số lượng</th><th>Đơn giá</th></tr></thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? '[Đã xóa]' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@endsection

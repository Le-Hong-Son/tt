@extends('layouts.app')

@section('title', 'Lịch sử đơn hàng')

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h2 class="mb-4">Lịch sử đơn hàng của bạn</h2>

    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Mã đơn</th>                
                        <th>Họ tên</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt</th>
                        <th>PT Thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @switch($order->payment_method)
                                    @case('cod') COD @break
                                    @case('bank') Chuyển khoản @break
                                    @case('vnpay') VNPAY @break
                                    @case('momo') Momo @break
                                    @default -
                                @endswitch
                            </td>
                            <td>{{ number_format($order->total, 0, ',', '.') }} VNĐ</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">Chờ xác nhận</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-primary">Đang xử lý</span>
                                @elseif($order->status == 'shipped')
                                    <span class="badge bg-info">Đã giao</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Đã hủy</span>
                                @else
                                    <span class="badge bg-secondary">Không xác định</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

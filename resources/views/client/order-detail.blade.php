@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h2 class="mb-4">Chi tiết đơn hàng #{{ $order->id }}</h2>

    <div class="mb-4">
        <h5>Thông tin người đặt</h5>
        <ul class="list-group">
            <li class="list-group-item"><strong>Họ tên:</strong> {{ $order->name }}</li>
            <li class="list-group-item"><strong>SĐT:</strong> {{ $order->phone }}</li>
            <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $order->address }}</li>
            <li class="list-group-item"><strong>Phương thức thanh toán:</strong> 
                @switch($order->payment_method)
                    @case('cod') COD @break
                    @case('bank') Chuyển khoản @break
                    @case('vnpay') VNPAY @break
                    @case('momo') Momo @break
                    @default -
                @endswitch
            </li>
            <li class="list-group-item"><strong>Trạng thái:</strong> 
                @if($order->status == 'pending')
                    <span class="badge bg-warning">Chờ xác nhận</span>
                @elseif($order->status == 'processing')
                    <span class="badge bg-primary">Đang xử lý</span>
                @elseif($order->status == 'shipped')
                    <span class="badge bg-info">Đã giao</span>
                @elseif($order->status == 'cancelled')
                    <span class="badge bg-danger">Đã hủy</span>
                @else
                    <span class="badge bg-secondary">{{ $order->status }}</span>
                @endif
            </li>
        </ul>
    </div>

    <div class="table-responsive">
        <h5>Sản phẩm đã đặt</h5>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="width: 100px;">
                            <img src="{{ asset('storage/' . $item->product->image) }}" width="80" alt="{{ $item->product->name }}">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($order->total, 0, ',', '.') }} VNĐ</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">← Quay lại</a>

        @if($order->status === 'pending')
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này không?')">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
            </form>
        @endif
        
        @if (in_array($order->status, ['cancelled', 'shipped']))
            <form action="{{ route('orders.reorder', $order->id) }}" method="POST" class="text-end">
                @csrf
                <button type="submit" class="btn btn-success">Mua lại</button> 
            </form>
        @endif

    </div>
</div>
@endsection

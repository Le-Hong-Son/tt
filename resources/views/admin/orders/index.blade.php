@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Danh sách đơn hàng</h3></div>
    <div class="card-body p-0">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th><th>Tên tài khoản</th><th>Tên người nhận hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th>PT Thanh toán</th><th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $od)
                <tr>
                    <td>{{ $od->id }}</td>
                    <td>{{ $od->user->name ?? 'Ẩn' }}</td>
                    <td>{{ $od->name }}</td>
                    <td>{{ number_format($od->total) }}</td>
                    <td>
                        @switch($od->status)
                            @case('pending')
                                <span class="badge bg-warning">Chờ xác nhận</span>
                                @break
                            @case('processing')
                                <span class="badge bg-primary">Đang xử lý</span>
                                @break
                            @case('shipped')
                                <span class="badge bg-info text-dark">Đã giao</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Không xác định</span>
                        @endswitch
                    </td>
                    <td>{{ $od->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @switch($od->payment_method)
                            @case('cod') COD @break
                            @case('bank') Chuyển khoản @break
                            @case('vnpay') VNPAY @break
                            @case('momo') Momo @break
                            @default -
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $od) }}" class="btn btn-info btn-sm">Chi tiết</a>
                        <a href="{{ route('orders.edit', $od) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('orders.destroy', $od) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer d-flex justify-content-center">
            {{ $orders->links() }}
        </div>

    </div>
</div>
@endsection

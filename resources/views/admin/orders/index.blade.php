@extends('admin.layout')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách đơn hàng</h2>
        {{-- Nếu bạn có chức năng thêm đơn hàng thủ công --}}
        {{-- <a href="{{ route('orders.create') }}" class="btn btn-primary">Thêm đơn hàng</a> --}}
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên tài khoản</th>
                <th>Người nhận</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Thanh toán</th>
                <th>Hành động</th>
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
                        <a href="{{ route('orders.show', $od) }}" class="btn btn-info btn-sm me-1">Chi tiết</a>
                        <a href="{{ route('orders.edit', $od) }}" class="btn btn-warning btn-sm me-1">Sửa</a>
                        <form action="{{ route('orders.destroy', $od) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links() }}
    </div>
@endsection

@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Danh sách đơn hàng</h3></div>
    <div class="card-body p-0">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $od)
                <tr>
                    <td>{{ $od->id }}</td>
                    <td>{{ $od->user->name ?? 'Ẩn' }}</td>
                    <td>{{ number_format($od->total) }}</td>
                    <td>{{ $od->status }}</td>
                    <td>{{ $od->created_at->format('d/m/Y H:i') }}</td>
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
    </div>
</div>
@endsection

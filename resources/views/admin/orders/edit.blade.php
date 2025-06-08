@extends('admin.layout')
@section('title', 'Sửa đơn hàng')
@section('content')
<div class="card card-warning">
    <div class="card-header"><h3 class="card-title">Sửa đơn hàng</h3></div>
    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Chờ xác nhận</option>
                    <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Đang xử lý</option>
                    <option value="shipped" {{ $order->status=='shipped'?'selected':'' }}>Đã giao</option>
                    <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Đã hủy</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Cập nhật</button>
        </div>
    </form>
</div>
@endsection

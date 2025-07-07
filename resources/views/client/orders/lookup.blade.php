@extends('layouts.app')

@section('title', 'Tra Cứu Đơn Hàng')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded-3">
                <div class="card-header bg-secondary text-white text-center">
                    <h4 class="mb-0">Tra cứu đơn hàng</h4>
                </div>
                <div class="card-body p-4">

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('client.order.lookup') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="order_code" class="form-label">Mã đơn hàng (ID)</label>
                            <input type="number" class="form-control" id="order_code" name="order_code" placeholder="Nhập mã đơn hàng..." required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại..." required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-block">🔍 Tra cứu đơn hàng</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

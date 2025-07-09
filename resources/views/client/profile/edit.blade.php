@extends('layouts.app')
@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header bg-warning text-white text-center">
                    <h4><i class="bi bi-pencil-square me-2"></i>Chỉnh sửa hồ sơ cá nhân</h4>
                </div>

                <div class="card-body px-4 py-4">
                    <form action="{{ route('client.profile.update') }}" method="POST">
                        @csrf

                        {{-- Họ tên --}}
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person"></i> Họ tên</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-telephone"></i> Số điện thoại</label>
                            <input type="text" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Địa chỉ --}}
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-geo-alt"></i> Địa chỉ</label>
                            <input type="text" name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $user->address) }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        {{-- Mật khẩu mới --}}
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-lock"></i> Mật khẩu mới <small>(nếu muốn đổi)</small></label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Nhập mật khẩu mới">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nhập lại mật khẩu --}}
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-lock-fill"></i> Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới">
                        </div>

                        {{-- Nút --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('client.profile.show') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

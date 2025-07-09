@extends('layouts.app')
@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="bi bi-person-circle me-2"></i> Hồ sơ cá nhân</h4>
                </div>
                <div class="card-body px-4 py-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong><i class="bi bi-person me-2"></i>Họ tên:</strong> {{ $user->name }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-envelope me-2"></i>Email:</strong> {{ $user->email }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-telephone me-2"></i>Số điện thoại:</strong> {{ $user->phone ?? '—' }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-geo-alt me-2"></i>Địa chỉ:</strong> {{ $user->address ?? '—' }}
                        </li>
                    </ul>

                    <div class="text-end mt-4">
                        <a href="{{ route('client.profile.edit') }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa hồ sơ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

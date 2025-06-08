@extends('admin.layout')
@section('title', 'Chi tiết người dùng')
@section('content')
<h2>Chi tiết người dùng</h2>
<ul class="list-group">
    <li class="list-group-item"><b>ID:</b> {{ $user->id }}</li>
    <li class="list-group-item"><b>Tên:</b> {{ $user->name }}</li>
    <li class="list-group-item"><b>Email:</b> {{ $user->email }}</li>
    <li class="list-group-item"><b>Vai trò:</b> {{ $user->role }}</li>
    <li class="list-group-item"><b>Địa chỉ:</b> {{ $user->address }}</li>
    <li class="list-group-item"><b>Số điện thoại:</b> {{ $user->phone }}</li>
</ul>
<a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">Quay lại</a>
@endsection

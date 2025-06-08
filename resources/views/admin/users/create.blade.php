@extends('admin.layout')
@section('title', 'Thêm người dùng')
@section('content')
<h2>Thêm người dùng mới</h2>
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Vai trò</label>
        <select name="role" class="form-control">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
@endsection

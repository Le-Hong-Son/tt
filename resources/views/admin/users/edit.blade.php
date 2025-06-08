@extends('admin.layout')
@section('title', 'Sửa người dùng')
@section('content')
<h2>Sửa thông tin người dùng</h2>
<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label>Vai trò</label>
        <select name="role" class="form-control">
            <option value="user" {{ $user->role=='user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Cập nhật</button>
</form>
@endsection

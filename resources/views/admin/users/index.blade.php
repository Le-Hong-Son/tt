@extends('admin.layout')
@section('title', 'Quản lý người dùng')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Danh sách người dùng</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm người dùng</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th><th>Tên</th><th>Email</th><th>Vai trò</th><th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role }}</td>
            <td>
                <a href="{{ route('users.show', $u) }}" class="btn btn-info btn-sm">Xem</a>
                <a href="{{ route('users.edit', $u) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('users.destroy', $u) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

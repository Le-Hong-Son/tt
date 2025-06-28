@extends('admin.layout')
@section('title', 'Quản lý danh mục')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách danh mục</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->description }}</td>
                <td>
                    <a href="{{ route('categories.show', $cat) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('categories.edit', $cat) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if ($categories->isEmpty())
            <tr>
                <td colspan="4" class="text-center">Chưa có danh mục nào.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $categories->links() }}
    </div>
@endsection

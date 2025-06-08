@extends('admin.layout')
@section('title', 'Quản lý sản phẩm')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách sản phẩm</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th>Kho</th><th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $sp)
            <tr>
                <td>{{ $sp->id }}</td>
                <td>{{ $sp->name }}</td>
                <td>{{ $sp->category->name ?? '' }}</td>
                <td>{{ $sp->price }}</td>
                <td>{{ $sp->stock }}</td>
                <td>
                    <a href="{{ route('products.edit', $sp) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('products.destroy', $sp) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

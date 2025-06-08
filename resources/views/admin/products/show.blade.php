@extends('admin.layout')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    <h2>Chi tiết sản phẩm</h2>
    <table class="table table-bordered w-50">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Tên</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Danh mục</th>
            <td>{{ $product->category->name ?? '' }}</td>
        </tr>
        <tr>
            <th>Giá</th>
            <td>{{ number_format($product->price) }}đ</td>
        </tr>
        <tr>
            <th>Kho</th>
            <td>{{ $product->stock }}</td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <th>Hình ảnh</th>
            <td>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="img" style="width:120px;height:120px;object-fit:cover;">
                @else
                    <span class="text-muted">Không có</span>
                @endif
            </td>
        </tr>
    </table>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
@endsection

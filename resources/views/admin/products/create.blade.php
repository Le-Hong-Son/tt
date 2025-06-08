@extends('admin.layout')
@section('title', 'Thêm sản phẩm')
@section('content')
    <h2>Thêm sản phẩm mới</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" min="0" required value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label>Số lượng kho</label>
            <input type="number" name="stock" class="form-control" min="0" required value="{{ old('stock') }}">
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Hình ảnh (tuỳ chọn)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Huỷ</a>
    </form>
@endsection

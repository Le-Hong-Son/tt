@extends('admin.layout')
@section('title', 'Sửa sản phẩm')
@section('content')
    <h2>Sửa sản phẩm</h2>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>
        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id)==$cat->id)?'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" min="0" required value="{{ old('price', $product->price) }}">
        </div>
        <div class="mb-3">
            <label>Số lượng kho</label>
            <input type="number" name="stock" class="form-control" min="0" required value="{{ old('stock', $product->stock) }}">
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Hình ảnh hiện tại:</label><br>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="img" style="width:80px;height:80px;object-fit:cover;">
            @else
                <span class="text-muted">Không có</span>
            @endif
        </div>
        <div class="mb-3">
            <label>Thay ảnh mới (tuỳ chọn)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Huỷ</a>
    </form>
@endsection

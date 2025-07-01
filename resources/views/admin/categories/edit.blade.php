@extends('admin.layout')
@section('title', 'Sửa danh mục')
@section('content')
<div class="card card-warning">
    <div class="card-header"><h3 class="card-title">Sửa danh mục</h3></div>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Cập nhật</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
@endsection

@extends('admin.layout')
@section('title', 'Chi tiết danh mục')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Chi tiết danh mục</h3></div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Tên:</strong> {{ $category->name }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@endsection

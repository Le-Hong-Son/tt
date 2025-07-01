@extends('admin.layout')

@section('title', 'Thêm bình luận')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container">
    <h2 class="mb-4">Thêm bình luận mới</h2>

    <form action="{{ route('admin.comments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Sản phẩm</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Người dùng</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control" rows="4">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection

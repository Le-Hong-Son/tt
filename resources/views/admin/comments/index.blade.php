@extends('admin.layout')

@section('title', 'Quản lý bình luận')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách bình luận</h2>
        {{-- Nếu cần nút thêm mới bình luận cho Admin --}}
        <a href="{{ route('admin.comments.create') }}" class="btn btn-primary">Thêm bình luận</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Người dùng</th>
                <th>Nội dung</th>
                <th>Ngày bình luận</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->product->name }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->created_at->format('H:i d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.comments.edit', $comment) }}" class="btn btn-warning btn-sm me-1">Sửa</a>
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bình luận này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $comments->links() }}
    </div>
@endsection

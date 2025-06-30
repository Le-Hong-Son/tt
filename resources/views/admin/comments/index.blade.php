@extends('admin.layout')

@section('title', 'Quản lý bình luận')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách bình luận</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
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
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Xóa bình luận này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $comments->links() }}
</div>
@endsection

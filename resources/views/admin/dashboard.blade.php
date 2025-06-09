@extends('admin.layout')
@section('title', 'Bảng điều khiển')
@section('content')
    <h2>Chào mừng bạn đến trang quản trị!</h2>
    <ul>
        <li><a href="{{ route('products.index') }}">Quản lý sản phẩm</a></li>
        <li><a href="{{ route('categories.index') }}">Quản lý danh mục</a></li>
        <li><a href="{{ route('users.index') }}">Quản lý người dùng</a></li>
        <li><a href="{{ route('orders.index') }}">Quản lý đơn hàng</a></li>
        <li>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </li>
    </ul>
@endsection

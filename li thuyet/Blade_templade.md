## Xuất dữ liệu ra màn hình

    {{ $variable }}: XSS (Cross-Site Scripting)
    {!! $variable !!}: không chống XSS

## Chỉ thị Blade

    @if...@elseif...@endif
    @for...@endfor
    @foreach...@endforeach
    @switch @case @break @default @endswitch

## Nạp view con

    @include('viewCon', ['var1' => 'biến vào view con'])

## Kết thừa
    @extends
    @yield('content')
    @section('content')
    @endsection (or @stop)

    @parent

    @stack ... @push

## Method form và CSRD Token

    @csrf
    @method

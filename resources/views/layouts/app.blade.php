<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SOPU')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.3);
            border: 1px solid #0d6efd;
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .social-link:hover {
            color: #ffd700 !important;
            /* Vàng ánh kim */
            transition: 0.3s ease;
        }
    </style>
</head>

<body>
    @include('layouts.partials.navbar')

    <main class="py-4">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <!-- jQuery (optional) -->
    @stack('scripts')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger intent="WELCOME" chat-title="banmohinh" agent-id="14217097-d5c2-40a5-8edd-919f731dde17"
        language-code="vi"></df-messenger>
</body>

</html>

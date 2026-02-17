<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Church Admin') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.min.js"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50">

    <main>
        @yield('content')
    </main>

    <script>
        // Initialize Lucide icons on page load
        lucide.createIcons();
    </script>
</body>
</html>
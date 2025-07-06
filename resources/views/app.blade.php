<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>
    @vite('resources/css/app.css')
</head>
<body>
<nav class="bg-gray-100 mb-4">
    <div class="container mx-auto px-4 flex items-center justify-between py-3">
        <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800">HelloContainer</a>
        <ul class="flex space-x-6">
            <li>
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition p-2">Home</a>
            </li>
            <li>
                <a href="{{ url('/orders') }}" class="text-gray-700 hover:text-blue-600 transition p-2">Orders</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <div class="w-1/4 bg-blue-600 text-white p-4">
            <h2 class="text-xl font-bold">Admin Panel</h2>
            <nav>
                <ul class="mt-6">
                    <li><a href="{{ route('admin.product_categories.index') }}" class="block py-2">Product Categories</a></li>
                    <!-- Add more links here as needed -->
                </ul>
            </nav>
        </div>

        <div class="w-3/4 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>

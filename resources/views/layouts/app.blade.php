<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Stayzen') }} - Book Your Perfect Stay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { orange: { 500: '#f97316' } } } }
        }
    </script>
</head>
<body class="bg-gray-50">
    @include('components.header')

    @if (session('success'))
            <div class="max-w-md mx-auto mb-4 p-4 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                <div class="flex items-start space-x-3">
                    <!-- Ícone opcional -->
                    <svg class="w-6 h-6 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    
                    <div class="flex-1">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>

                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700 text-xl leading-none">&times;</button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-md mx-auto mb-4 p-4 bg-red-50 border border-red-200 rounded-lg shadow-sm">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    
                    <div class="flex-1">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                    
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700 text-xl leading-none">&times;</button>
                </div>
            </div>
        @endif
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
    
    @include('components.footer')
    
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>

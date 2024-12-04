<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to TokoKita</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Roboto', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-lg">
            <div class="w-full px-4">
                <div class="flex justify-start h-16 items-center">
                    <span class="text-xl font-bold text-gray-800">TokoKita</span>
                </div>
            </div>
        </nav>
        
    
        <!-- Welcome Section -->
        <div class="flex-grow flex items-center justify-center">
            <div class="text-center bg-white p-10 rounded-lg shadow-lg">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to TokoKita Website</h1>
                <p class="text-gray-600 mb-8">Find great products and offers just for you!</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">Register</a>
                </div>
            </div>
        </div>
        
    </body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TokoKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Register to TokoKita</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-1">Name</label>
                    <input id="name" class="block mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Email</label>
                    <input id="email" class="block mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 mb-1">Address</label>
                    <input id="address" class="block mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="address" :value="old('address')" required autofocus autocomplete="address">
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-700 mb-1">Phone Number</label>
                    <input id="phone_number" class="block mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number">
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="mb-4 col-span-1 md:col-span-2">
                    <label for="role" class="block text-gray-700 mb-1">Register as Seller</label>
                    <input id="role" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="role" value="seller">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1">Password</label>
                    <input id="password" class="block mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" class="block mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password_confirmation" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between mb-4">
                <a class="text-blue-500 hover:underline" href="{{ route('login') }}">
                    Already registered?
                </a>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-300">Register</button>
        </form>
    </div>
</body>
</html>
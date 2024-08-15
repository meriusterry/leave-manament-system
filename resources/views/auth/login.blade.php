<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>


<body class="flex items-center justify-center min-h-screen bg-white-90">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">

        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40">
        </div>

        <h2 class="text-2xl font-bold mb-4">Sign In</h2>
        <form action="{{ Route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus
                    class="mt-1 block w-full px-3 py-2 border border-gray-300  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('email')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="Password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
                <div class="mt-2 flex items-center ">
                    <input type="checkbox" id="showPassword" class="mr-2 rounded-md" onclick="togglePassword()">
                    <label for="showPassword" class="text-sm ">Show my password</label>
                </div>
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="w-full py-2 px-4 border border-transparent text-sm font-medium  text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">LOGIN
                    -></button>
            </div>
            <div class="text-center">
                <a href="{{ url('forgot-password') }}" class="text-sm text-gray-600 hover:text-gray-900">Forgot
                    Password?</a>
            </div>
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">Not Registered? <a href="{{ route('register') }}"
                        class="text-blue-600 hover:underline">Free Signup</a></p>
            </div>
        </form>
    </div>
    <script>
        function togglePassword() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
</body>

</html>

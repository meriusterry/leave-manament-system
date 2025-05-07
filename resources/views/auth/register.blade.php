<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>


<body class="flex items-center justify-center h-screen bg-white-90">

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">

        <div class="bg-red-500 border-l-4 border-red-500 text-white p-4 mb-2" role="alert">
            <p class="font-bold">Notice</p>
            <p>Sign-up is disabled. Only administrators can add new users.</p>
        </div>
        
        
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40">
        </div>
      

        <form class="space-y-2" action="#" method="POST">
            @csrf
            <h2 class="text-2xl font-bold mb-6 text-center">REGISTRATION</h2>
            
            <div class="flex space-x-4 mb-4">
                <div class="form-group w-1/2">
                    <label for="firstName" class="block mb-2 text-sm font-medium text-gray-700">First Name *</label>
                    <input disabled type="text" id="firstName" name="firstName" placeholder="John"
                        class="w-full px-3 py-2 border border-gray-300 bg-gray-100 cursor-not-allowed">
                </div>
        
                <div class="form-group w-1/2">
                    <label for="surname" class="block mb-2 text-sm font-medium text-gray-700">Surname *</label>
                    <input disabled type="text" id="surname" name="surname" placeholder="Dube"
                        class="w-full px-3 py-2 border border-gray-300 bg-gray-100 cursor-not-allowed">
                </div>
            </div>
        
            <div class="flex space-x-4 mb-4">
                <div class="form-group w-1/2">
                    <label for="mobileNumber" class="block mb-2 text-sm font-medium text-gray-700">Mobile Number *</label>
                    <input disabled type="text" id="mobileNumber" name="mobileNumber" placeholder="10 digits phone number"
                        class="w-full px-3 py-2 border border-gray-300 bg-gray-100 cursor-not-allowed">
                </div>
        
                <div class="form-group w-1/2">
                    <label for="customerType" class="block mb-2 text-sm font-medium text-gray-700">Customer Type *</label>
                    <select disabled id="customerType" name="customerType"
                        class="w-full px-3 py-2 border border-gray-300 bg-gray-100 cursor-not-allowed">
                        <option value="" disabled selected>Select Customer Type</option>
                        <option value="individual">Individual</option>
                        <option value="business">Business</option>
                    </select>
                </div>
            </div>
        
            <div class="form-group">
                <label for="email" class="block mb-2 text-sm">Email Address *</label>
                <input disabled type="email" id="email" name="email" placeholder="Email Address"
                    class="w-full px-3 py-2 border border-gray-300 bg-gray-100 cursor-not-allowed">
            </div>
        
            <div class="form-group">
                <label for="password" class="block mb-2 text-sm">Password *</label>
                <input disabled type="password" id="password" name="password" placeholder="Password"
                    class="w-full px-3 py-2 border border-gray-300 bg-gray-100 cursor-not-allowed">
                <div class="mt-2">
                    <input disabled type="checkbox" id="showPassword" onclick="togglePassword()" class="mr-2 rounded-md cursor-not-allowed">
                    <label for="showPassword" class="text-sm text-gray-400">Show password</label>
                </div>
            </div>
        
            <button type="submit" disabled
                class="w-full py-2 px-4 border border-transparent text-sm font-medium text-white bg-gray-400 cursor-not-allowed">
                REGISTER
            </button>
        
            <p class="mt-4 text-center text-gray-900">Have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
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

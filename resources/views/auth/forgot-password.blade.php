<x-guest-layout>
    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40">
    </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                       <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <div class="mb-4">
                        <label for="email" class="">Email Address</label>
                        <input id="email" type="email" name="email" placeholder="Email Address" required autofocus class="w-full p-2 border border-gray-300  mt-1">
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="w-full py-2 bg-black text-white  hover:bg-gray-800">
                            Send Password Reset Link
                        </button>
                    </div>
                   
                    <div class="text-center mt-4">
                    
                        <p class="mt-4 text-center">Remember Password? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
                    </div>
                </form>

</x-guest-layout>

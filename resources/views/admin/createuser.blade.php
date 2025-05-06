<x-app-layout>
  
    
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="bg-white shadow  p-6">
   
            <div class="p-0 text-gray-900">
    
                <button onclick="history.back()" class="bg-white-500 text-black font-bold py-0 px-0  text-2xl hover:bg-gray-100">
                    < Back </button>
                    <hr class="my-4">
        <form class="space-y-2" action="{{ Route('admin.createuser') }}" method="POST">
            @csrf
            <h2 class="text-xl font-bold mb-6 ">Add User</h2>
            
            <div class="flex space-x-4 mb-4">
                <div class="form-group w-1/2">
                    <label for="firstName" class="block mb-2 text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="eg.John"  class="w-full px-3 py-2 border border-gray-300 "
                    value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
                    @error('firstName')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-group w-1/2">
                    <label for="surname" class="block mb-2 text-sm font-medium text-gray-700">Surname</label>
                    <input type="text" id="surname" name="surname" placeholder="eg.Sandeson"  class="w-full px-3 py-2 border border-gray-300 "
                    value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                    @error('surname')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror 
            </div>

            </div>
            <div class="flex space-x-4 mb-4">
            <div class="form-group w-1/2">
                <label for="mobileNumber" class="block mb-2 text-sm font-medium text-gray-700">Mobile Number</label>
                <input type="text" id="mobileNumber" name="mobileNumber" placeholder="10 digits phone number"  class="w-full px-3 py-2 border border-gray-300  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                value="{{ old('mobileNumber') }}" required autocomplete="mobileNumber" autofocus >
                @error('mobileNumber')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror 

            </div>
            <div class="form-group w-1/2">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-700">Department</label>
                <input type="text" id="department" name="department" placeholder="eg.Billing"  class="w-full px-3 py-2 border border-gray-300 "
                value="{{ old('department') }}" required autocomplete="department" autofocus>
                @error('department')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
            </div>

        </div>

        <div class="flex space-x-4 mb-4">
            <div class="form-group w-1/2">
                <label for="position" class="block mb-2 text-sm font-medium text-gray-700">Position</label>
                <input type="text" id="position" name="position" placeholder="eg.Software Tester"  class="w-full px-3 py-2 border border-gray-300 "
                value="{{ old('position') }}" required autocomplete="position" autofocus>
                @error('position')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group w-1/2">
                <label for="customerType" class="block mb-2 text-sm font-medium text-gray-700">Customer Type</label>
                <select id="customerType" name="customerType"  class="w-full px-3 py-2 border border-gray-300  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                value="{{ old('customerType') }}" required autocomplete="customerType" autofocus>
                    <option value="" disabled selected>Select Customer Type</option>
                    <option value="individual">Individual</option>
                    <option value="business">Business</option>
                </select>
                @error('customerType')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror 
            </div>

        </div>
            <div class="form-group">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" placeholder="eg.example@gmail.com"  class="w-full px-3 py-2 border border-gray-300 "
                value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror 
            </div>

            <div class="form-group">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="eg.Example@55"  class="w-full px-3 py-2 border border-gray-300 ">
                @error('password')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror 
               
            </div>

            <button type="submit" class="w-full py-2 px-4 border border-transparent text-sm font-medium  text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 ">
                CREATE</button>
        </form>
    </div>

</body>
            
</x-app-layout>

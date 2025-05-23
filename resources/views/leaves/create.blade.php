<x-app-layout>
  

    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                <div class="p-0 text-gray-900">

                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

                </div>
              
                <h2 class="text-lg text-gray-900 mt-2 font-bold">Create Leave</h2>
               
                <form id="create" class="mt-4 space-y-4" method="post" action="{{ route('leaves.create') }}">
                   <div>
    @csrf
    <label for="leave_types" class="block text-sm font-medium text-gray-700">Leave Types</label>
    <select id="leave_types" name="leave_types"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        required autocomplete="leave_types" autofocus>
        <option disabled {{ old('leave_types') ? '' : 'selected' }}>Select Leave Type</option>
        @foreach ($leaveTypes as $leaveType)
            <option value="{{ $leaveType->leave_type }}" {{ old('leave_types') == $leaveType->leave_type ? 'selected' : '' }}>
                {{ $leaveType->leave_type }}
            </option>
        @endforeach
    </select>
    @error('leave_types')
        <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror
</div>


                    <div class="flex items-center space-x-8 ">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 block w-full py-2 px-6 border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ old('start_date') }}" required autocomplete="start_date" autofocus>
                @error('start_date')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" id="end_date" name="end_date"
                                class="mt-1 block w-full py-2 px-6 border border-gray-300  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ old('end_date') }}" required autocomplete="end_date" autofocus>
                @error('end_date')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror

                        </div>
                    </div>

                    <label for="end_date" class="block text-sm font-medium text-gray-700">Requested balance</label>
                    <div class="bg-green-500 border border-green-400 text-black-700 px-4 py-3  relative"
                        role="alert">
                        <div>
                            <p id="date_difference" class="text-lg font-medium text-gray-700"></p>

                        </div>
                        <input type="hidden" id="hidden_date_difference" name="date_difference" value="">


                    </div>
                   
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Reason for
                            Leave</label>
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Description"></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="history.back()"
                            class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500"
                            >Cancel</button>

                        <button type="submit"
                            class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                            Create Leave</button>
                    </div>
                </form>

            
         
                
                <script>
                    let holidays = [];
                
                    // Fetch holidays from the server
                    async function fetchHolidays() {
                        try {
                            const response = await fetch("{{ route('fetch-holidays') }}");
                            if (response.ok) {
                                holidays = await response.json();
                                console.log("Fetched holidays:", holidays);
                            } else {
                                console.error("Failed to fetch holidays");
                            }
                        } catch (error) {
                            console.error("Error fetching holidays:", error);
                        }
                    }
                
                    fetchHolidays(); // Call fetchHolidays to populate the holidays array
                
                    function isWeekend(date) {
                        const day = date.getDay();
                        return day === 0 || day === 6; // Sunday = 0, Saturday = 6
                    }
                
                    function isHoliday(date) {
                        const formattedDate = date.toISOString().split('T')[0]; // Format date as 'YYYY-MM-DD'
                        return holidays.includes(formattedDate);
                    }
                
                    function calculateDateDifference() {
                        const startDateInput = document.getElementById('start_date').value;
                        const endDateInput = document.getElementById('end_date').value;
                
                        if (startDateInput && endDateInput) {
                            const start = new Date(startDateInput);
                            const end = new Date(endDateInput);
                
                            let count = 0;
                            let currentDate = new Date(start);
                
                            while (currentDate <= end) {
                                if (!isWeekend(currentDate) && !isHoliday(currentDate)) {
                                    count++;
                                }
                                currentDate.setDate(currentDate.getDate() + 1);
                            }
                
                            // Update the display and hidden input
                            document.getElementById('date_difference').textContent = `${count} day(s)`;
                            document.getElementById('hidden_date_difference').value = count;
                        } else {
                            // Reset the display and hidden input
                            document.getElementById('date_difference').textContent = '';
                            document.getElementById('hidden_date_difference').value = '';
                        }
                    }
                
                    // Add event listeners
                    document.getElementById('start_date').addEventListener('change', calculateDateDifference);
                    document.getElementById('end_date').addEventListener('change', calculateDateDifference);
                </script>
                  

            </div>
        </div>
    </div>

</x-app-layout>

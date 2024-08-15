<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Leave Management') }}
        </h2>
    </x-slot>

    <body class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-0 px-0">
            <div class="px-4 py-5 sm:px-1">
                <div class="mt-0">


                    <!-- Hidden form for editing holidays -->
                    <div id="edit-holiday-form-container" class="hidden">
                        <form class="space-y-2" action="{{ route('updateHoliday',$holidays) }}" method="POST"
                            id="edit-holiday-form">
                            @csrf
                            @method('PATCH')

                            <div class="flex space-x-4 mb-4 mt-4">
                                <div class="form-group">
                                    <label for="edit_date"
                                        class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" id="edit_date" name="date"
                                        class="w-full px-3 py-2 border border-gray-300" required autocomplete="date"
                                        autofocus>
                                    @error('date')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group w-1/4">
                                    <label for="edit_holiday"
                                        class="block mb-2 text-sm font-medium text-gray-700">Holiday</label>
                                    <input type="text" id="edit_holiday" name="holiday"
                                        class="w-full px-3 py-2 border border-gray-300" required autocomplete="holiday"
                                        autofocus>
                                    @error('holiday')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group w-1/4">
                                    <label for="edit_day"
                                        class="block mb-2 text-sm font-medium text-gray-700">Day</label>
                                    <select id="edit_day" name="day"
                                        class="w-full px-3 py-2 border border-gray-300" required autocomplete="day"
                                        autofocus>
                                        <option disabled selected>Select Day</option>
                                        <option>Sunday</option>
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                    </select>
                                    @error('day')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="px-0 sm:px-1 mt-8">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update Holiday
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- JavaScript to handle the edit button click and show the form with populated data -->
                    <script>
                        function openEditHolidayForm(date, holiday, day) {

                            document.getElementById('edit_date').value = date;
                            document.getElementById('edit_holiday').value = holiday;
                            document.getElementById('edit_day').value = day;
                            document.getElementById('edit-holiday-form-container').classList.remove('hidden');
                        }

                        function closeEditHolidayForm() {
                            document.getElementById('edit-holiday-form-container').classList.add('hidden');
                        }
                    </script>


                    <div id="hiddenForm" class="hidden w-full">
                        <!-- Hidden initially with 'hidden' class -->
                        <!-- Your form content goes here -->

                        <form class="space-y-2" action="{{ Route('admin.holidays') }}" method="POST">
                            @csrf
                            <div class="flex space-x-4 mb-4 mt-4">

                                <div class="form-group ">
                                    <label for="date"
                                        class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" id="date" name="date" min="1" max="100"
                                        placeholder="eg.07/11/2024" class="w-full px-3 py-2 border border-gray-300"
                                        value="{{ old('date') }}" required autocomplete="date" autofocus>
                                    @error('date')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group w-1/4">
                                    <label for="holiday"
                                        class="block mb-2 text-sm font-medium text-gray-700">Holiday</label>
                                    <input type="text" id="holiday" name="holiday" min="1" max="100"
                                        placeholder="eg.Christmas Day" class="w-full px-3 py-2 border border-gray-300"
                                        value="{{ old('holiday') }}" required autocomplete="holiday" autofocus>
                                    @error('holiday')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group w-1/4">
                                    <label for="day"
                                        class="block mb-2 text-sm font-medium text-gray-700">Day</label>

                                    <select id="day" name="day"
                                        class="w-full px-3 py-2 border border-gray-300" value="{{ old('day') }}"
                                        required autocomplete="day" autofocus>
                                        <option disabled selected>Select Day</option>
                                        <option>Sunday</option>
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                    </select>

                                    @error('days')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="px-0 sm:px-1 mt-8 ">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Add Holiday</button>
                                </div>
                        </form>
                    </div>
                    <hr class="my-6">

                </div>
            </div>

            <div class="px-0 sm:px-1 flex justify-end ">
                <a href="#" id="showFormButton"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Holiday
                </a>
            </div>

            <script>
                // JavaScript to toggle visibility of the hidden form
                const showFormButton = document.getElementById('showFormButton');
                const hiddenForm = document.getElementById('hiddenForm');

                showFormButton.addEventListener('click', function() {
                    hiddenForm.classList.toggle('hidden'); // Toggle the 'hidden' class on the hiddenForm div
                });
            </script>

            <div class="mt-2"></div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-300">
                        <tr>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Holiday#</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Date</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Holiday</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Day</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                Action</th>

                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">


                        @foreach ($holidays as $holidays)
                            <tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ $holidays->id }} </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ $holidays->date }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $holidays->holiday }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $holidays->day }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                    <div class="holiday-item">

                                        <a onclick="openEditHolidayForm('{{ $holidays->date }}', '{{ $holidays->holiday }}', '{{ $holidays->day }}')"
                                            class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Edit</a>
                                    </div>

                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="flex">

                </div>
            </div>
            
        </div>
        
    </body>

    <div class="flex justify-between items-center mt-4 mb-2">
        <div class="text-sm text-gray-700">
            Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of
            {{ $tableData->total() }} holidays
        </div>
        <div class="flex">
            @if ($tableData->previousPageUrl())
                <a href="{{ $tableData->previousPageUrl() }}"
                    class="px-1 py-1 text-sm font-small text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-md">Previous</a>
            @endif

            @foreach ($tableData as $leave)
                <!--  <a href="#" class="ml-3 px-1 py-1 text-sm font-small text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-md"></a>-->
            @endforeach

            @if ($tableData->nextPageUrl())
                <a href="{{ $tableData->nextPageUrl() }}"
                    class="ml-3 px-1 py-1 text-sm font-small text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-md">Next</a>
            @endif
        </div>
    </div>
</x-app-layout>

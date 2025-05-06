<x-app-layout>
    
    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">
        <div id="edit-holiday-form-container" class="hidden mb-6 bg-white p-6  shadow-md">
            <form action="{{ route('updateHoliday', $holidays) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="edit_date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" id="edit_date" name="date"
                               class="w-full  border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('date')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="edit_holiday" class="block text-sm font-medium text-gray-700">Holiday</label>
                        <input type="text" id="edit_holiday" name="holiday"
                               class="w-full  border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('holiday')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="edit_day" class="block text-sm font-medium text-gray-700">Day</label>
                        <select id="edit_day" name="day"
                                class="w-full  border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option disabled selected>Select Day</option>
                            @foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                                <option>{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('day')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2  hover:bg-indigo-700 transition">
                        Update Holiday
                    </button>
                </div>
            </form>
        </div>

        <!-- Add Holiday Button -->
        <div class="flex justify-end mb-4">
            <a href="#" id="showFormButton"
               class="bg-indigo-600 text-white px-4 py-2  hover:bg-indigo-700 transition">
                Add Holiday
            </a>
        </div>

        <!-- Add Holiday Form -->
        <div id="hiddenForm" class="hidden mb-6 bg-white p-6  shadow-md">
            <form action="{{ route('admin.holidays') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}"
                               class="w-full  border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('date')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="holiday" class="block text-sm font-medium text-gray-700">Holiday</label>
                        <input type="text" id="holiday" name="holiday" value="{{ old('holiday') }}"
                               class="w-full  border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('holiday')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="day" class="block text-sm font-medium text-gray-700">Day</label>
                        <select id="day" name="day"
                                class="w-full  border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <option disabled selected>Select Day</option>
                            @foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                                <option>{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('day')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2  hover:bg-indigo-700 transition">
                        Add Holiday
                    </button>
                </div>
            </form>
        </div>

        <!-- Holiday Table -->
        <div class="bg-white shadow overflow-hidden">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left text-sm font-medium text-gray-900">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Holiday</th>
                        <th class="px-6 py-3">Day</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">
                    @foreach ($holidays as $holiday)
                        <tr>
                            <td class="px-6 py-4">{{ $holiday->id }}</td>
                            <td class="px-6 py-4">{{ $holiday->date }}</td>
                            <td class="px-6 py-4">{{ $holiday->holiday }}</td>
                            <td class="px-6 py-4">{{ $holiday->day }}</td>
                            <td class="px-6 py-4">
                                <button onclick="openEditHolidayForm('{{ $holiday->date }}', '{{ $holiday->holiday }}', '{{ $holiday->day }}')"
                                        class="text-indigo-600 hover:underline">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
            <div>
                Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of {{ $tableData->total() }} holidays
            </div>
            <div class="space-x-2">
                @if ($tableData->previousPageUrl())
                    <a href="{{ $tableData->previousPageUrl() }}"
                       class="px-3 py-1 rounded-md border border-gray-300 bg-white hover:bg-gray-100">
                        Previous
                    </a>
                @endif
                @if ($tableData->nextPageUrl())
                    <a href="{{ $tableData->nextPageUrl() }}"
                       class="px-3 py-1 rounded-md border border-gray-300 bg-white hover:bg-gray-100">
                        Next
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openEditHolidayForm(date, holiday, day) {
            document.getElementById('edit_date').value = date;
            document.getElementById('edit_holiday').value = holiday;
            document.getElementById('edit_day').value = day;
            document.getElementById('edit-holiday-form-container').classList.remove('hidden');
        }

        document.getElementById('showFormButton')?.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('hiddenForm').classList.toggle('hidden');
        });
    </script>
</x-app-layout>

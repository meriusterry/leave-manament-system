<x-app-layout>
    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    <div class="bg-white p-4  shadow">


                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 mb-4">
                            <!-- Total Leaves (shows all) -->
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-blue-400 text-white p-2 shadow-sm block hover:bg-blue-500 transition">
                                <div class="text-sm font-semibold">Total Leaves</div>
                                <div class="text-sm font-bold">{{ $total }}</div>
                            </a>

                            <!-- Pending -->
                            <a href="{{ route('admin.dashboard', ['status' => 'Pending']) }}"
                                class="bg-orange-400 text-white p-2 shadow-sm block hover:bg-orange-500 transition">
                                <div class="text-sm font-semibold">Pending</div>
                                <div class="text-sm font-bold">{{ $pendingapproval }}</div>
                            </a>

                            <!-- Approved -->
                            <a href="{{ route('admin.dashboard', ['status' => 'Approved']) }}"
                                class="bg-green-400 text-white p-2 shadow-sm block hover:bg-green-500 transition">
                                <div class="text-sm font-semibold">Approved</div>
                                <div class="text-sm font-bold">{{ $approved }}</div>
                            </a>

                            <!-- Declined -->
                            <a href="{{ route('admin.dashboard', ['status' => 'Declined']) }}"
                                class="bg-red-400 text-white p-2 shadow-sm block hover:bg-red-500 transition">
                                <div class="text-sm font-semibold">Declined</div>
                                <div class="text-sm font-bold">{{ $declined }}</div>
                            </a>
                        </div>



                        <div class="flex justify-end items-center gap-x-4 mb-4">
                            <!-- Filter by Status -->
                            <form method="GET" class="flex items-center gap-2">
                                <label for="status" class="font-medium">Filter by Status:</label>
                                <select name="status" id="status" onchange="this.form.submit()"
                                    class="border-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-1">
                                    <option value="">-- All --</option>
                                    <option value="Pending"
                                        {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="Declined" {{ request('status') == 'Declined' ? 'selected' : '' }}>
                                        Declined</option>
                                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </form>

                            <!-- Search Form -->
                            <form method="GET" class="flex items-center gap-2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by name or position"
                                    class="border-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-60 px-3 py-1" />

                                @if (request('search') || request('status'))
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="text-sm text-gray-700 underline hover:text-red-600">Reset</a>
                                @endif

                                <button type="submit"
                                    class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                    Search
                                </button>
                            </form>
                        </div>




                        <!-- Leave Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm text-left text-gray-600">
                                <thead class="bg-gray-900 text-white">
                                    <tr>
                                        <th class="px-4 py-2 font-medium">Employee#</th>
                                        <th class="px-4 py-2 font-medium">Employee Name</th>
                                        <th class="px-4 py-2 font-medium">Leave Type</th>
                                        <th class="px-4 py-2 font-medium">Duration</th>
                                        <th class="px-4 py-2 font-medium">Applied On</th>
                                        <th class="px-4 py-2 font-medium">Status</th>
                                        <th class="px-4 py-2 font-medium">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableData as $data)
                                        <tr class="border-t">
                                            <td class="px-4 py-2">{{ $data->user_id }}</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center">
                                                    <!-- Profile Icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-10 w-10 text-gray-600 cursor-pointer" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A9.003 9.003 0 0112 15c2.364 0 4.515.92 6.121 2.414M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>

                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $data->user->firstName }} {{ $data->user->surname }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">{{ $data->user->position }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-2">{{ $data->leave_types }}</td>
                                            <td class="px-4 py-2">
                                                {{ $data->start_date }} → {{ $data->end_date }} <br>
                                                <span class="text-sm text-gray-500">{{ $data->date_difference }}
                                                    day(s)</span>
                                            </td>
                                            <td class="px-4 py-2">{{ $data->created_at }}</td>
                                            <td class="px-4 py-2">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $data->status == 'Approved'
                                                        ? 'bg-green-200 text-green-800'
                                                        : ($data->status == 'Declined'
                                                            ? 'bg-red-200 text-red-800'
                                                            : ($data->status == 'Cancelled'
                                                                ? 'bg-blue-200 text-blue-800'
                                                                : 'bg-yellow-100 text-yellow-800')) }}">
                                                    {{ $data->status }}
                                                </span>
                                            </td>



                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.approval', ['id' => $data->id]) }}"
                                                    class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                                    View</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-between items-center mt-4">
                            <div class="text-sm text-gray-700">
                                Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of
                                {{ $tableData->total() }} leaves
                            </div>
                            <div>
                                {{ $tableData->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>

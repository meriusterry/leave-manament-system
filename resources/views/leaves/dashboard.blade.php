<x-app-layout>

    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">


                <div class="bg-white shadow  p-6">

                    {{-- Leave Balances --}}
                    @if ($leaveBalances->isEmpty())
                        <p class="text-sm text-gray-600 mb-4">You have not been assigned any leave types.</p>
                    @else
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($leaveBalances as $data)
                                


                                <a href="#"
                                class="bg-green-100 text-gray-700 p-2 shadow-sm block transition">
                                <div class="text-sm font-semibold"></div>
                                <div class="text-sm font-bold">{{ $data->leave_type }}: {{ $data->balance }} Day(s)</div>
                            </a>


                            @endforeach
                        </div>
                    @endif


                    <div class="flex justify-end items-center gap-4 mb-4">
                        {{-- Filter by Status --}}
                        <form method="GET" class="flex items-center gap-2">
                            <label for="status" class="font-medium">Filter by Status:</label>
                            <select name="status" id="status" onchange="this.form.submit()"
                                class="border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-1">
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

                        {{-- Create Leave Button --}}
                        <a href="{{ route('leaves.create') }}"
                            class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                            Create Leave
                        </a>
                    </div>

                    {{-- Leave Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm text-left text-gray-600">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="px-4 py-2 font-medium  ">Employee#</th>
                                    <th class="px-4 py-2 font-medium  ">Leave Type</th>
                                    <th class="px-4 py-2 font-medium ">Duration</th>
                                    <th class="px-4 py-2 font-medium">Applied On</th>
                                    <th class="px-4 py-2 font-medium ">Status</th>
                                    <th class="px-4 py-2 font-medium ">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                                @foreach ($tableData as $data)
                                    <tr>
                                        <td class="px-6 py-4">{{ $data->user_id }}</td>
                                        <td class="px-6 py-4">{{ $data->leave_types }}</td>
                                        <td class="px-6 py-4">
                                            {{ $data->start_date }} → {{ $data->end_date }}<br>
                                            <span class="text-xs text-gray-500">{{ $data->date_difference }}
                                                day(s)</span>
                                        </td>
                                        <td class="px-6 py-4">{{ $data->created_at }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $data->status == 'Approved'
                                                ? 'bg-green-100 text-green-800'
                                                : ($data->status == 'Declined'
                                                    ? 'bg-red-100 text-red-800'
                                                    : ($data->status == 'Cancelled'
                                                        ? 'bg-blue-100 text-blue-800'
                                                        : 'bg-yellow-100 text-yellow-800')) }}">
                                                {{ $data->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('leaves.show', ['id' => $data->id]) }}"
                                                class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex justify-between items-center mt-6">
                        <div class="text-sm text-gray-600">
                            Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of
                            {{ $tableData->total() }} leaves
                        </div>
                        <div class="flex space-x-2">
                            @if ($tableData->previousPageUrl())
                                <a href="{{ $tableData->previousPageUrl() }}"
                                    class="px-3 py-1 text-sm bg-white border border-gray-300  hover:bg-gray-50">
                                    Previous
                                </a>
                            @endif
                            @if ($tableData->nextPageUrl())
                                <a href="{{ $tableData->nextPageUrl() }}"
                                    class="px-3 py-1 text-sm bg-white border border-gray-300  hover:bg-gray-50">
                                    Next
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
    </div>
</x-app-layout>

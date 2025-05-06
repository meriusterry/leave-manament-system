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
                            <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1">
                                {{ $data->leave_type }}: {{ $data->balance }} Day(s)
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Create Leave Button --}}
                <div class="flex justify-end mb-4">
                    <a href="{{ route('leaves.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium  hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Create Leave
                    </a>
                </div>

                {{-- Leave Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-sm text-left text-gray-600">
                        <thead class="bg-gray-100 text-gray-900">
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
                                        <span class="text-xs text-gray-500">{{ $data->date_difference }} day(s)</span>
                                    </td>
                                    <td class="px-6 py-4">{{ $data->created_at }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $data->status == 'Approved' ? 'bg-green-100 text-green-800' :
                                                ($data->status == 'Declined' ? 'bg-red-100 text-red-800' :
                                                ($data->status == 'Cancelled' ? 'bg-blue-100 text-blue-800' :
                                                'bg-yellow-100 text-yellow-800')) }}">
                                            {{ $data->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('leaves.show', ['id' => $data->id]) }}"
                                            class="inline-block px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-100">
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
                        Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of {{ $tableData->total() }} leaves
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

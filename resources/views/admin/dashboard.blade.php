<x-app-layout>
    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    <div class="bg-white p-4  shadow">
                     

                        <!-- Leave Summary Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 mb-4">
                            <div class="bg-blue-400 text-white  p-2 shadow-sm">
                                <div class="text-sm font-semibold">Total Leaves </div>
                                <div class="text-sm font-bold">{{ $total }}</div>
                            </div>
                            <div class="bg-orange-400 text-white p-2 shadow-sm">
                                <div class="text-sm font-semibold">Pending</div>
                                <div class="text-sm font-bold">{{ $pendingapproval }}</div>
                            </div>
                            <div class="bg-green-400 text-white  p-2 shadow-sm">
                                <div class="text-sm font-semibold">Approved</div>
                                <div class="text-sm font-bold">{{ $approved }}</div>
                            </div>
                            <div class="bg-red-400 text-white  p-2 shadow-sm">
                                <div class="text-sm font-semibold">Declined</div>
                                <div class="text-sm font-bold">{{ $declined }}</div>
                            </div>
                        </div>
                        

                        <!-- Leave Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm text-left text-gray-600">
                                <thead class="bg-gray-100 text-gray-900">
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
                                                    <img class="h-10 w-10 " src="{{ asset('images/logo.png') }}" alt="Logo">
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $data->user->firstName }} {{ $data->user->surname }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">{{ $data->user->position }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-2">{{ $data->leave_types }}</td>
                                            <td class="px-4 py-2">
                                                {{ $data->start_date }} → {{ $data->end_date }} <br>
                                                <span class="text-sm text-gray-500">{{ $data->date_difference }} day(s)</span>
                                            </td>
                                            <td class="px-4 py-2">{{ $data->created_at }}</td>
                                            <td class="px-4 py-2">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $data->status == 'Approved' ? 'bg-green-200 text-green-800' :
                                                       ($data->status == 'Declined' ? 'bg-red-200 text-red-800' :
                                                       ($data->status == 'Cancelled' ? 'bg-blue-200 text-blue-800' :
                                                       'bg-yellow-100 text-yellow-800')) }}">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                           
                                              

                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.approval', ['id' => $data->id]) }}"
                                                        class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

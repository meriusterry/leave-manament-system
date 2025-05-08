<x-app-layout>
    

    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">

            {{-- Create User Button --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.createuser') }}"
                   class="inline-block px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">
                    Create User
                </a>
            </div>

            {{-- Users Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left text-gray-600">
                    <thead class="bg-gray-900 text-white">
                        <tr>
                            <th class="px-4 py-2 font-medium">Employee#</th>
                            <th class="px-4 py-2 font-medium">Employee Name</th>
                            <th class="px-4 py-2 font-medium">Email</th>
                            <th class="px-4 py-2 font-medium">Department</th>
                            <th class="px-4 py-2 font-medium">Position</th>
                            <th class="px-4 py-2 font-medium">Status</th>
                            <th class="px-4 py-2 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @foreach ($tableData as $data)
                            <tr>
                                <td class="px-4 py-2">{{ $data->id }}</td>
                                <td class="px-4 py-2">{{ $data->firstName }} {{ $data->surname }}</td>
                                <td class="px-4 py-2">{{ $data->email }}</td>
                                <td class="px-4 py-2">{{ $data->department }}</td>
                                <td class="px-4 py-2">{{ $data->position }}</td>
                                <td class="px-4 py-2">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $data->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $data->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-2 flex-wrap">
                                        @if ($data->access == 'True')
                                            <form method="POST" action="{{ route('blockaccess', $data->id) }}">
                                                @csrf
                                                <button type="submit" onclick="return confirmBlock();"
                                                    class="px-3 py-1 text-sm bg-red-600 text-white  hover:bg-red-700">
                                                    Block Permission
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('giveaccess', $data->id) }}">
                                                @csrf
                                                <button type="submit" onclick="return confirmAccess();"
                                                    class="px-3 py-1 text-sm bg-green-600 text-white  hover:bg-green-700">
                                                    Allow Permission
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('destroyuser', $data->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirmDeleteUser();"
                                                    class="px-3 py-1 text-sm bg-white border border-gray-300  hover:bg-gray-100">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-gray-600">
                    Showing {{ $tableData->firstItem() }} to {{ $tableData->lastItem() }} of {{ $tableData->total() }} Users
                </div>
                <div class="flex space-x-2">
                    @if ($tableData->previousPageUrl())
                        <a href="{{ $tableData->previousPageUrl() }}"
                            class="px-3 py-1 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Previous
                        </a>
                    @endif
                    @if ($tableData->nextPageUrl())
                        <a href="{{ $tableData->nextPageUrl() }}"
                            class="px-3 py-1 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Next
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- JS Confirmations --}}
    <script>
        function confirmBlock() {
            return confirm("Are you sure you want to block permission?");
        }

        function confirmAccess() {
            return confirm("Are you sure you want to allow permission?");
        }

        function confirmDeleteUser() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</x-app-layout>

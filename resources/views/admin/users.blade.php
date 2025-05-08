<x-app-layout>
    

    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end items-center gap-x-4 mb-2">
                        <!-- Filter by Access -->
                        <form method="GET" class="flex items-center gap-2">
                            <label for="access" class="font-medium">Filter by Permissions:</label>
                            <select name="access" id="access" onchange="this.form.submit()"
                                class="border-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-1">
                                <option value="">-- All --</option>
                                <option value="True" {{ request('access') == 'True' ? 'selected' : '' }}>True</option>
                                <option value="False" {{ request('access') == 'False' ? 'selected' : '' }}>False</option>
                            </select>
                        </form>
                    
                        <!-- Search Form -->
                        <form method="GET" class="flex items-center gap-2">
                            <input type="text" name="search" value="{{ request('search') }}"
    placeholder="Search by Name or position"
    class="border-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-60 px-3 py-1" />

                    
                            @if (request('search') || request('access'))
                                <a href="{{ route('admin.users') }}"
                                    class="text-sm text-gray-700 underline hover:text-red-600">Reset</a>
                            @endif
                    
                            <button type="submit"
                                class="py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                Search
                            </button>
                        </form>
                        
                            <a href="{{ route('admin.createuser') }}"
                               class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                Create User
                            </a>
                        
                    </div>
                    
            {{-- Create User Button --}}
            

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
                                                    class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                                    Block Permission
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('giveaccess', $data->id) }}">
                                                @csrf
                                                <button type="submit" onclick="return confirmAccess();"
                                                    class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                                    Allow Permission
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('destroyuser', $data->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirmDeleteUser();"
                                                    class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
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

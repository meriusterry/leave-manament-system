<x-app-layout>
 

    <script src="{{ asset('js/javascript.js') }}"></script>

    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    <button onclick="history.back()" class="bg-white-500 text-black font-bold py-0 px-0 rounded text-2xl hover:bg-gray-100">
                        < Back </button>
                        <hr class="my-4">
                            <div class="grid grid-cols-2 gap-5 mb-10 text-gray-700">
                                <div>
                                    <p class="font-semibold">EMPLOYEE ID</p>
                                    <p>{{ $leave->user_id }} </p>
                                </div>
                                <div>
                                    <p class="font-semibold">LEAVE TYPE</p>
                                    <p>{{ $leave->leave_types }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">DURATION</p>
                                    <p> {{ $leave->start_date }} to {{ $leave->end_date }}<br/>
                                        {{ $leave->date_difference }} day(s)</p>
                                </div>
                                <div>  
                                    <p class="font-semibold">APPLIED ON</p>
                                    <p> {{ $leave->created_at }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">STATUS</p>
                                    <p>{{ $leave->status }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">DESCRIPTION</p>
                                    <p> {{ $leave->description }}</p>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                               



                                    <form method="POST" action="{{ route('cancel', $leave->id) }}">
                                        @csrf
                                       
                                          
                                        
                                        @if ($leave->status == 'Cancelled' || $leave->status == 'Approved' || $leave->status == 'Declined' )
                                        
                                        <button type="submit"  class="py-2 px-4 border border-transparent  shadow-sm text-sm font-medium text-gray-500 bg-gray-300 cursor-not-allowed">
                                            Cancel Leave
                                        </button>
                                        
                                    @else
                                    <button type="submit"  onclick="return confirmCancel()"class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"">
                                        Cancel Leave
                                    </button>
                                    @endif
                                    </form>

                                    <script>
                                        function confirmCancel() {
                                             return confirm('Are you sure you want to cancel this leave?');
                                            }
                                    </script>


                                @if ($leave->status == 'Approved' || $leave->status == 'Declined')
                                    <span
                                        class="py-2 px-4 border border-transparent  shadow-sm text-sm font-medium text-gray-500 bg-gray-300 cursor-not-allowed">
                                        Edit Leave
                                    </span>
                                @else
                                    <a href="{{ route('leaves.edit', $leave->id) }}"
                                        class="py-2 px-4 border border-transparent  shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Edit Leave
                                    </a>
                                @endif

                            </div>

                            <script>
                                function redirectToDashboard() {
                                    window.location.href = '{{ route('leaves.dashboard') }}';
                                }
                            </script>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

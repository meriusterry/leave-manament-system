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
                                    <p class="font-bold text-gray-900">EMPLOYEE ID</p>
                                    <p>{{ $leave->user_id }} </p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">LEAVE TYPE</p>
                                    <p>{{ $leave->leave_types }}</p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">DURATION</p>
                                    <p> {{ $leave->start_date }} to {{ $leave->end_date }}<br/>
                                        {{ $leave->date_difference }} day(s)</p>
                                </div>
                                <div>  
                                    <p class="font-bold text-gray-900">APPLIED ON</p>
                                    <p> {{ $leave->created_at }}</p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">STATUS</p>
                                    <p>{{ $leave->status }}</p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">DESCRIPTION</p>
                                    <p> {{ $leave->description }}</p>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                               



                                    <form method="POST" action="{{ route('cancel', $leave->id) }}">
                                        @csrf
                                       
                                          
                                        
                                     
                                        @if ($leave->status != 'Cancelled' && $leave->status != 'Approved' && $leave->status != 'Declined')
    <button type="submit" onclick="return confirmCancel()"
        class="inline-block px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">
        Cancel Leave
    </button>
@endif

</form>

<script>
    function confirmCancel() {
        return confirm('Are you sure you want to cancel this leave?');
    }
</script>

@if ($leave->status != 'Approved' && $leave->status != 'Declined')
    <a href="{{ route('leaves.edit', $leave->id) }}"
        class="inline-block px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">
        Edit Leave
    </a>
@endif

{{-- 🟡 Message for non-editable leaves --}}
@if (in_array($leave->status, ['Cancelled', 'Approved', 'Declined']))
    <p class="mt-4 text-sm text-red-600 font-semibold">
        Attended leaves cannot be updated or cancelled.
    </p>
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

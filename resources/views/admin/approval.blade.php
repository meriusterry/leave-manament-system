<x-app-layout>
 

    <script src="{{ asset('js/javascript.js') }}"></script>

    <div class="flex">
        <!-- Main content -->
        <main class="flex-1 p-0">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('leaves.approval', $leave->id) }}" method="POST" style="display:inline;">
                        @csrf

                        <button onclick="history.back()"
                            class="bg-white-500 text-black font-bold py-0 px-0  text-2xl hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <-Back </button>
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
                                            {{ $leave->date_difference }}day(s)
                                        </p>
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
                                    <button  formaction= "{{ route('decline', $leave->id) }}" onclick="confirmDecline({{ $leave->id }})" 
                                        class="py-2 px-4 border border-transparent  shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Decline
                                    </button>  

                                   
                                

                                    <div>
                                        <button id="approveButton" type="submit"
                                            class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Approve
                                        </button>
                                    </div>

                    </form>

                    <script>
                        function redirectToDashboard() {
                            window.location.href = '{{ route('leaves.dashboard') }}';
                        }
                    </script>

                    <script>
                        document.getElementById("approveButton").onclick = function() {
                            approveAction();
                        };

                        function approveAction() {
                            // Show a confirmation dialog
                            const isConfirmed = confirm("Are you sure you want to approve the leave?");

                            if (isConfirmed) {
                                // If confirmed, submit the form
                                document.getElementById("leaveForm").submit();
                            } else {
                                //Do nothing 

                                history.back()
                            }
                        }
                    </script>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                    <script>
                        function confirmDecline(leaveId) {
                            var reason = window.prompt("Please enter the reason for declining:");
                            
                            if (reason !== null && reason.trim() !== "") {
                                // Submit the form with the reason
                                var form = document.createElement('form');
                                form.method = 'POST';
                                form.action = "{{ route('decline', $leave->id) }}";
                                form.style.display = 'none';
                    
                                var reasonField = document.createElement('input');
                                reasonField.type = 'hidden';
                                reasonField.name = 'reason';
                                reasonField.value = reason;
                                form.appendChild(reasonField);
                    
                                document.body.appendChild(form);
                                form.submit();
                            }
                        }
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<x-app-layout>
   
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm ">
                <div class="p-4 text-gray-900 dark:text-gray-100 ">
            <div class="grid grid-cols-2 gap-4 ">

                <!-- Left half -->
                <form class="space-y-2" action="{{ Route('createleavetypes.store') }}" method="POST">
                    @csrf
        
                <div class="bg-white p-4  w-4/4">
                    <h2 class="text-xl font-bold mb-4 ">Add Leave Types</h2>
                <div class="form-group w-4/4">
    <label for="leave_type" class="block mb-2 text-sm font-medium text-gray-700">Leave Type</label>
    <select id="leave_type" name="leave_type" class="w-full px-3 py-2 border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
        <option value="" disabled selected>Select a leave type</option>
        <option value="Annual Leave" {{ old('leave_type') == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
        <option value="Sick Leave" {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
        <option value="Maternity Leave" {{ old('leave_type') == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
        <option value="Parental Leave" {{ old('leave_type') == 'Parental Leave' ? 'selected' : '' }}>Parental Leave</option>
        <option value="Family Responsibility Leave" {{ old('leave_type') == 'Family Responsibility Leave' ? 'selected' : '' }}>Family Responsibility Leave</option>
        <option value="Unpaid Leave" {{ old('leave_type') == 'Unpaid Leave' ? 'selected' : '' }}>Unpaid Leave</option>
        <option value="Study Leave" {{ old('leave_type') == 'Study Leave' ? 'selected' : '' }}>Study Leave</option>
        <option value="Religious Leave" {{ old('leave_type') == 'Religious Leave' ? 'selected' : '' }}>Religious Leave</option>
        <option value="Injury on Duty Leave" {{ old('leave_type') == 'Injury on Duty Leave' ? 'selected' : '' }}>Injury on Duty Leave</option>
    </select>
    @error('leave_type')
        <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror
</div>


                    <div class="flex space-x-4 mb-4 mt-4">
                        <div class="form-group w-3/4">
                            <label for="entitlement" class="block mb-2 text-sm font-medium text-gray-700">Entitlement</label>
                            <input type="number" id="entitlement" name="entitlement" min="1" max="100" placeholder="eg.20"  class="w-full px-3 py-2 border border-gray-300 "
                            value="{{ old('entitlement') }}" required autocomplete="entitlement" autofocus>
                            @error('entitlement')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                        </div>
        
                        <div class="form-group w-3/4">
                            <label for="balance" class="block mb-2 text-sm font-medium text-gray-700">Balance</label>
                            <input type="number" id="balance" name="balance" min="1" max="100" placeholder="eg.20"  class="w-full px-3 py-2 border border-gray-300 "
                            value="{{ old('balance') }}" required autocomplete="balance" autofocus>
                            @error('balance')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror 
                    </div>
        
                    </div>

                   

                    <div class="form-group">
                        <label for="payable"class="mb-1 text-sm font-medium text-gray-700">Payable?</label><br>
                        <input type="radio" id="payable_yes" name="payable" value="1" required> Yes
                        <input type="radio" id="payable_no" name="payable" value="0" required> No
                    </div>
       
                    <button type="submit" class=" mt-6 w-full py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500 ">
                        CREATE</button>

                </div>
            </form>
                
                <!-- Right half -->
                <div class="bg-white p-4 shadow-md  ">
                    <h1 class="text-xl font-bold mb-2 ">Leave Types</h1>
                    <div class="flex space-x-4">
                        
                        <div class="flex ">
                            
                            <div class="mt-2"></div>
                            <div class="mt-2 overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-600">
                                    <thead class="bg-gray-900 text-white">
                                    <tr>
                                        <th scope="col"
                                        class="px-4 py-2 font-medium">
                                        Leave#</th>
                                        <th scope="col"
                                            class="px-4 py-2 font-medium">
                                            Leave Type</th>
                                        <th scope="col"
                                            class="px-4 py-2 font-medium">
                                            Entitlement</th>
                                            <th scope="col"
                                            class="px-4 py-2 font-medium">
                                            Balance</th>
                                            
                                        <th scope="col"
                                            class="px-4 py-2 font-medium">
                                            Action</th>
                                       
                                            
                                    </tr>
                                </thead>
                               
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($leaveType as $leaveType)
                                        <tr>
                                        
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $leaveType->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $leaveType->leave_type }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $leaveType->entitlement }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $leaveType->balance }} </td>
                                    
                                                <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    
                                                    <form  action="{{ route('destroyleavetypes', $leaveType->id) }}" method="POST" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button  onclick="return confirmDeleteLeavetype()"
                                                       class="py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500">
                                                        Delete
                                                    </button>
                                                    </form>
                                                </td>     
                                                </td>
                                        </tr>

                                    @endforeach
    
                                </tbody>
                            </table>

                        </div>
                        
                        <script>
                            function confirmDeleteLeavetype() {
                                 return confirm('Are you sure you want to delete leave type?');
                                }
                        </script>
                    </div
                </div>
            </div>
        </div>
       

</x-app-layout>

<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Models\UserLeaveBalance;

class LeaveBalanceController extends Controller
{
   /* public function assignLeaveBalance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'leave_type_id' => 'required|exists:leave_types,id',
        ]);

        $leaveType = LeaveType::findOrFail($request->leave_type_id);
        
        $userLeaveBalance = UserLeaveBalance::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'leave_type_id' => $request->leave_type_id,
            ],
            [
                'leave_type' => $leaveType->leave_type,
                'balance' => $leaveType->balance,
            ]
        );

        return response()->json($userLeaveBalance);
    }

/////////////////////////////////////////////////////////////////////////

public function updateLeaveBalance(Request $request, $leaveTypeId) {
    // Retrieve the value from the input field
    $dateDifference = (int)$request->input('date_difference');
    
    // Fetch the current leave balance for the given $leaveTypeId
    $balance = UserLeaveBalance::where('leave_type_id', $leaveTypeId)->firstOrFail();
    
    // Perform the subtraction
    $currentBalance = $balance->balance;
    $newBalance = $currentBalance - $dateDifference;
    
    // Update the leave balance in the database
    $balance->update(['balance' => $newBalance]);
    
    // Optionally, you can return a response or redirect as needed
    return redirect()->back()->with('success', 'Leave balance updated successfully');
}
*/
}

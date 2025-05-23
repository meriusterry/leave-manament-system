<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Models\UserLeaveBalance;

class LeaveTypeController extends Controller
{

    public function store(Request $request)
{
    $request->validate([
        'leave_type' => 'required|string|max:255',
        'entitlement' => 'required|integer|min:1',
        'balance' => 'required|integer|min:1|lte:entitlement', // balance must be ≤ entitlement
        'payable' => 'required|boolean',
    ]);

    $leaveType = LeaveType::create($request->all());

    $users = User::all();
    foreach ($users as $user) {
        UserLeaveBalance::create([
            'user_id' => $user->id,
            'leave_type_id' => $leaveType->id,
            'balance' => $leaveType->balance,
            'leave_type' => $leaveType->leave_type,
        ]);
    }

    return redirect()->route('admin.createleavetypes')->with('success', 'Leave Type Added successfully.');
}


    public function data()
    {
        //Fetch  all Leave Types from the database
        $leaveType = LeaveType::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.createleavetypes', compact('leaveType'));
    }

    public function destroyleavetypes($id)
    {
        $record = LeaveType::find($id);

        if ($record) {
            $record->delete();

            return redirect()->route('admin.createleavetypes')->with('success', 'Leave Type deleted successfully.');
        } else {

            return redirect()->route('admin.createleavetypes')->with('error', 'Leave Type not found.');
        }
    }


}

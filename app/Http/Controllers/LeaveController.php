<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\Holidays;
use App\Models\LeaveType;
use App\Mail\LeaveApproved;
use Illuminate\Http\Request;
use App\Models\UserLeaveBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\LeaveRequested;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


class LeaveController extends Controller
{
    public function index()
    {
        // Fetch leaves created by the logged-in user
        $tableData = Auth::user()->leaves()->where('status', '!=', 'Cancelled')->orderBy('created_at', 'desc')->paginate(10);
        $leaveBalances = Auth::user()->leaveBalances()->with('leaveType')->get();
        return view('leaves.dashboard', compact('tableData', 'leaveBalances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leaveTypes = LeaveType::all();
        return view('leaves.create', ['leaveTypes' => $leaveTypes]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'leave_types' => 'required|string|max:255',
            'start_date' => 'required|date|max:255',
            'end_date' => 'required|date|max:255',
            'date_difference' => 'required|integer|min:1',
            'description' => 'required|string|max:255',

        ]);

        $validatedData['user_id'] = Auth::user()->id;

        // Calculate the number of business days between start_date and end_date
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));


        $businessDays = $this->calculateBusinessDays($start_date, $end_date);

        if ($start_date > $end_date) {
            return redirect()->back()->withErrors(['Start date must be less than end date']);
        }
        if ($businessDays <= 0) {
            return redirect()->back()->withErrors(['Requested balance must be greater than zero']);
        }

        // Check if the date difference matches the calculated business days
        if ($request->input('date_difference') != $businessDays) {
            return redirect()->back()->withErrors(['Requested balance does not match the number of business days']);
        }


        // Check if leave balance is sufficient
        $userLeaveBalance = UserLeaveBalance::where('user_id', Auth::user()->id)
            ->where('leave_type', $request->input('leave_types'))
            ->first();

        if (!$userLeaveBalance || $userLeaveBalance->balance < $businessDays) {
            return redirect()->back()->withErrors(['Insufficient leave balance.']);
        }

        // Create a new leave record
        $leave = Leave::create($validatedData);

        // Update leave balance
        $userLeaveBalance->balance -= $businessDays;
        $userLeaveBalance->save();

        // Notify admin
        $admin = User::where('access', 'True')->first();
        if ($admin) {
            $admin->notify(new LeaveRequested($leave));
        }

        // Redirect based on user role
        if (auth()->user()->access === 'True') {
            return redirect('dashboard')->with('success', 'Leave Submitted successfully!');
        } else {
            return redirect('dashboard')->with('success', 'Leave Submitted successfully!');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = Leave::findOrFail($id);
        return view('leaves.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leaveTypes = LeaveType::all();
        return view('leaves.edit', compact('leave', 'leaveTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        // Validate request data
        $validatedData = $request->validate([
            'leave_types' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'date_difference' => 'required|integer|min:1',
            'description' => 'required|string|max:255',
        ]);

        // Store the original leave details
        $originalLeaveType = $leave->leave_types;
        $originalStartDate = Carbon::parse($leave->start_date);
        $originalEndDate = Carbon::parse($leave->end_date);

        // Update the leave record with new data
        $leave->leave_types = $validatedData['leave_types'];
        $leave->start_date = $validatedData['start_date'];
        $leave->end_date = $validatedData['end_date'];
        $leave->date_difference = $validatedData['date_difference'];
        $leave->description = $validatedData['description'];
        $leave->save();

        // Recalculate business days for the new and old leave types
        $newStartDate = Carbon::parse($validatedData['start_date']);
        $newEndDate = Carbon::parse($validatedData['end_date']);
        $newBusinessDays = $this->calculateBusinessDays($newStartDate, $newEndDate);

        $originalBusinessDays = $this->calculateBusinessDays($originalStartDate, $originalEndDate);

        // Update leave balance for the old leave type
        $oldLeaveBalance = UserLeaveBalance::where('user_id', Auth::user()->id)
            ->where('leave_type', $originalLeaveType)
            ->first();

        if ($oldLeaveBalance) {
            $oldLeaveBalance->balance += $originalBusinessDays; // Return the original balance
            $oldLeaveBalance->save();
        }

        // Update leave balance for the new leave type
        $newLeaveBalance = UserLeaveBalance::where('user_id', Auth::user()->id)
            ->where('leave_type', $validatedData['leave_types'])
            ->first();

        if (!$newLeaveBalance) {
            // If the new leave type does not exist, you may need to handle it, e.g., create a new balance record
            $newLeaveBalance = new UserLeaveBalance();
            $newLeaveBalance->user_id = Auth::user()->id;
            $newLeaveBalance->leave_type = $validatedData['leave_types'];
            $newLeaveBalance->balance = 0;
        }

        $newLeaveBalance->balance -= $newBusinessDays; // Deduct the new balance
        $newLeaveBalance->save();

        return redirect()->route('leaves.dashboard')->with('success', 'Leave updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cancel($id)
    {
        // Find the leave record by ID
        $leave = Leave::find($id);

        if ($leave) {
            // Check if the leave is already cancelled or declined
            if ($leave->status === 'Cancelled' || $leave->status === 'Declined') {
                return redirect()->route('leaves.dashboard')->with('info', 'Leave request is already cancelled or declined.');
            }

            // Update the leave status to Cancelled
            $leave->status = 'Cancelled';
            $leave->save();

            // Revert the leave balance
            $this->adjustLeaveBalance($leave, 1); // Positive to add balance back

            return redirect()->route('leaves.dashboard')->with('success', 'Leave cancelled successfully.');
        }

        return redirect()->route('leaves.dashboard')->with('error', 'Leave request not found.');
    }

    /**
     * Adjust the leave balance based on the leave request.
     *
     * @param Leave $leave
     * @param int $factor
     * @return void
     */
    private function adjustLeaveBalance(Leave $leave, int $factor)
    {
        // Calculate the number of business days
        $start_date = Carbon::parse($leave->start_date);
        $end_date = Carbon::parse($leave->end_date);
        $businessDays = $this->calculateBusinessDays($start_date, $end_date);

        // Update the user’s leave balance
        $userLeaveBalance = UserLeaveBalance::where('user_id', $leave->user_id)
            ->where('leave_type', $leave->leave_types)
            ->first();

        if ($userLeaveBalance) {
            $userLeaveBalance->balance += $factor * $businessDays;
            $userLeaveBalance->save();
        }
    }

    /**
     * Calculate the number of business days between two dates, excluding weekends and holidays.
     *
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @return int
     */
    private function calculateBusinessDays(Carbon $start_date, Carbon $end_date)
    {
        // Fetch holidays from the database and parse them into Carbon instances
        $holidays = Holidays::pluck('date')->map(function ($date) {
            return Carbon::parse($date)->toDateString();
        })->toArray();

        // Initialize business days count
        $businessDays = 0;
        $currentDate = $start_date->copy();

        while ($currentDate->lte($end_date)) {
            // Check if the current date is a weekday and not a holiday
            if ($currentDate->isWeekday() && !in_array($currentDate->toDateString(), $holidays)) {
                $businessDays++;
            }
            // Move to the next day
            $currentDate->addDay();
        }

        return $businessDays;
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\Holidays;
use App\Mail\LeaveApproved;
use Illuminate\Http\Request;
use App\Models\UserLeaveBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class LeaveManagementController extends Controller
{
    public function data(Request $request)
    {
        $query = Leave::where('status', '!=', 'Cancelled')->with('user');

        // Filter by status if selected
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

    // Search by firstName, surname, or position (case-insensitive)
if ($request->filled('search')) {
    $searchTerm = strtolower($request->search);
    $query->whereHas('user', function ($q) use ($searchTerm) {
        $q->where(DB::raw('LOWER(firstName)'), 'like', '%' . $searchTerm . '%')
            ->orWhere(DB::raw('LOWER(surname)'), 'like', '%' . $searchTerm . '%')
            ->orWhere(DB::raw('LOWER(position)'), 'like', '%' . $searchTerm . '%');
    });
}

        $tableData = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());

        // Summary Cards
        $total = Leave::where('status', '!=', 'Cancelled')->count();
        $pendingapproval = Leave::where('status', 'Pending')->count();
        $approved = Leave::where('status', 'Approved')->count();
        $declined = Leave::where('status', 'Declined')->count();

        return view('admin.dashboard', compact(
            'tableData',
            'total',
            'pendingapproval',
            'approved',
            'declined'
        ));
    }


    public function approval(string $id)
    {
        $leave = Leave::findOrFail($id);
        return view('admin.approval', compact('leave'));
    }

    public function approve($id)
    {
        // Find the leave record by ID
        $leave = Leave::find($id);

        if ($leave) {
            // Check if the current status is Declined
            if ($leave->status === 'Declined') {
                // Calculate the number of business days
                $start_date = Carbon::parse($leave->start_date);
                $end_date = Carbon::parse($leave->end_date);
                $businessDays = $this->calculateBusinessDays($start_date, $end_date);

                // Deduct the balance for the leave
                $this->adjustLeaveBalances($leave, -1); // Negative to deduct balance
            }

            // Update the leave status to Approved
            $leave->status = 'Approved';
            $leave->save();

            // Send an email to the user
            Mail::to($leave->user->email)->send(new LeaveApproved($leave));

            return redirect()->route('admin.dashboard')->with('success', 'Leave approved successfully.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Leave request not found.');
    }

    /**
     * Adjust the leave balance based on the leave request.
     *
     * @param Leave $leave
     * @param int $factor
     * @return void
     */
    private function adjustLeaveBalances(Leave $leave, int $factor)
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

    public function decline($id, Request $request)
    {
        // Find the leave record by ID
        $leave = Leave::find($id);

        if ($leave) {
            // Update the leave status to Declined
            $leave->status = 'Declined';

            // Validate and set the reason for declining
            /* $request->validate([
                'reason' => 'required|string|max:255',
            ]);
            $leave->reason = $request->input('reason');*/
            $leave->save();

            // Revert the leave balance
            $this->adjustLeaveBalance($leave, 1); // Positive to add balance back

            // Send an email to the user
            //  Mail::to($leave->user->email)->send(new LeaveDeclined($leave));

            // Send email to the user
            Mail::to($leave->user->email)->send(new LeaveApproved($leave));

            return redirect()->route('admin.dashboard')->with('success', 'Leave declined successfully.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Leave request not found.');
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

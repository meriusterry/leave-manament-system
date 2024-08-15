<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Models\UserLeaveBalance;


class UsersController extends Controller
{
    public function create()
    {
        return view('admin.createuser');
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'mobileNumber' => ['required', 'string', 'max:255'],
            'department'  => ['required', 'string', 'max:255'],
            'position'  => ['required', 'string', 'max:255'],
            'customerType' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ]
        ]);

        // Create a new record in the database 
        $user = User::create($validatedData);

        $leaveTypes = LeaveType::all();
        foreach ($leaveTypes as $leaveType) {
            UserLeaveBalance::create([
                'user_id' => $user->id,
                'leave_type_id' => $leaveType->id,
                'balance' => $leaveType->balance,
                'leave_type' => $leaveType->leave_type,
            ]);
        }

        return redirect('users')->with('success', 'User created successfully!');
    }


    public function data()
    {
        //Fetch  all Users members from the database
        $tableData = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('tableData'));
    }


    public function giveaccess($id, Request $request)
    {
        $users = User::find($id);

        if ($users) {
            $users->access = 'True';
            $users->save();

            return redirect()->route('admin.users')->with('success', 'Permision Granted successfully.');
        }

        return redirect()->route('admin.users')->with('error', 'Something went wrong.');
    }

    public function blockaccess($id, Request $request)
    {
        $users = User::find($id);

        if ($users) {
            $users->access = 'False';
            $users->save();

            return redirect()->route('admin.users')->with('success', 'Permision Blocked successfully.');
        }

        return redirect()->route('admin.users')->with('error', 'Something went wrong.');
    }


    public function destroyuser($id)
    {
        $record = User::find($id);

        if ($record) {
            $record->delete();

            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        } else {

            return redirect()->route('admin.users')->with('error', 'User not found.');
        }
    }
}

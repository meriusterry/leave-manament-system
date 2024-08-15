<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveType extends Model
{
    use HasFactory;


    protected $table = 'leave_types';

    protected $fillable = [
        'leave_type' ,
        'entitlement',
        'balance' ,
        'payable',

    ];

    public function leaveBalances()
    {
        return $this->hasMany(UserLeaveBalance::class);
    }

}



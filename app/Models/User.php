<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users'; 

    protected $fillable = [
        'firstName', 
        'surname', 
        'mobileNumber', 
        'department', 
        'position', 
        'customerType', 
        'email', 
        'password',

    ];



   /* public static function assignLeaveTypesToAll()
    {
        $users = self::all();
        $leaveTypes = LeaveType::all();

        foreach ($users as $user) {
            $user->leaveTypes()->sync($leaveTypes);
        }
    }*/


    use Notifiable;

    public function leaveBalances()
    {
        return $this->hasMany(UserLeaveBalance::class);
    }

   /* public function leaveTypes()
    {
        return $this->belongsToMany(LeaveType::class, 'user_leave_types')->withTimestamps();
    }*/

   

    /*  // Password mutator
      public function setPasswordAttribute($value)
      {
          $this->attributes['password'] = bcrypt($value);
      }

       // Password mutator
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
*/
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    
}
//User::assignLeaveTypesToAll();

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'leaves';

    protected $fillable = [
        'user_id',
        'leave_types',
        'start_date',
        'end_date',
        'date_difference',
        'description',


    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

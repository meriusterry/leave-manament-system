<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;

class AssignLeaveTypesCommand extends Command
{
   
   
 //protected $signature = 'leave-types:assign';

    //protected $description = 'Assign all leave types to all users';

     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave-types:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign all leave types to all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        User::assignLeaveTypesToAll();
        $this->info('Leave types assigned to all users successfully.');
    }
}

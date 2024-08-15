<!DOCTYPE html>
<html>
<head>
    <title>Leave status</title>
</head>
<body>
    <h1>Leave {{ $leave->status }}</h1>
    <p>Dear {{ $leave->user->firstName }} {{ $leave->user->surname }},</p> 
    <p>Your  {{ $leave->leave_types }} leave request of {{ $leave->date_difference }} day(s) from {{ $leave->start_date }} to {{ $leave->end_date }}
        has been {{ $leave->status }}.</p>
    <p>Thank you.</p>
    <p>DIGITAL XPERT</p>   
</body>
</html>

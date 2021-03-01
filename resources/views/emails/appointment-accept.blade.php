@component('mail::message')
Dear {{ $data['patientName'] }}
Your appointment is being accepted
Date: {{ $data['date']  }}
Day: {{ $data['day']  }}
Time:{{ $data['startingTime'] }}
Doctor:{{ $data['doctorName'] }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent

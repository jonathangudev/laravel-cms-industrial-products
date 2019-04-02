@component('mail::message')
#Contact Submitted

Name: {{$contactName}} <br>
Company: {{$contactCompany}} <br>
Email: {{$contactEmail}} <br>
Phone: {{$contactPhone}} <br>
Message: {{$contactMessage}}
@endcomponent 
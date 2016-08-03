<html>
<body>
 
    <p>Hi {{$userDetail->name or ''}},</p>
    <p>Thank you for visiting {{$hotspot->shortname or ''}} - we hope you're satisfied with the way we served you. </p>
    <p>We would love to know more about your experience. To leave your feedback, please answer the question below.</p>
    <br>
    <h3>Would you recommend your experience at {{$hotspot->shortname or ''}} to your friends ?</h3>
    
    <a style="" href="{{ url("/") }}/feedback/{{ $feedback_code }}" target="_blank">Yes, I had a good times !</a>
	<br><br>
	<a href="mailto:{{$userDetail->email or 'survey@clicspot.fr'}}?subject=Thank you for taking the time to answer our survey!&body=We%20appreciate%20the%20feedback.%0D%0A%0D
	We%20strive%20to%20always%20provide%20the%20best%20services%20but%20sometimes%20it%20could%20happen%20that%20our%20client%20are%20not%20fully%20satisfied.%0D%0A%0D
	Would%20you%20give%20us%20your%20opinion%20and%20your%20recommendation%20to%20improve%20our%20services%20?%0D%0A%0D
	Thank%20you%0D%0A%0D
	{{$hotspot->shortname or ''}} Team%0D%0A%0D
	Please, type%20your%20comment%20below&#58;%0D%0A%0D%0D%0A%0D" target="_top">Not really, but I will tell you why.</a>
    <br><br>
    <p>(Please note: this question applies only to the service you received from your representative. To leave feedback on service or policies, please reply to this email.)</p>
    <p>Thanks for sharing your feedback—it will help to improve our services.</p>
    <br>
    <p>Best regards,</p>
    <p>{{$hotspot->shortname or ''}} Team</p>
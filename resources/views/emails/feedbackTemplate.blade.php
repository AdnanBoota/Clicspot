<html>
<body>
 
    <p>Hi {{$userDetail->name or ''}},</p>
    <p>Thank you for visiting {{$hotspot->shortname or ''}} - we hope you're satisfied with the way we served you. </p>
    <p>We would love to know more about your experience. To leave your feedback, please answer the question below.</p>
    <br>
    <h3>How would you rate your experience at {{$hotspot->shortname or ''}} ?</h3>
    
    <a style="" href="{{ url("/") }}/feedback/{{ $feedback_code }}" target="_blank">Good, I'm satisfied</a>
    <p>Bad, I'm unsatisfied</p>
    <br><br>
    <p>(Please note: this question applies only to the service you received from your representative. To leave feedback on service or policies, please reply to this email.)</p>
    <p>Thanks for sharing your feedback—it will help to improve our services.</p>
    <br>
    <p>Best regards,</p>
    <p>{{$hotspot->shortname or ''}} Team</p>
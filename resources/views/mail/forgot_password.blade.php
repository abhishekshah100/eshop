@php
    $website_settings=App\WebsiteSetting::where('id','1')->first();
@endphp
<!DOCTYPE html>
<html>
<head>
	<title>Password Reset Verification</title>
</head>
<body>
	Dear <strong>{{ $details['name'] }}</strong>, <br>
	You recently requested a new password.
	<br>
	<br>
	Please click the link below to complete your new password request:
	<br>
	<a href="{{ $website_settings->website_url }}/changepassword/{{ $details['email'] }}/{{ $details['verification_code'] }}"><strong>LINK</strong></a>
		<br><br>

	Please note that this email has been sent to all contact emails associated with your account. If you did not request a new password, someone may have been trying to access your account without permission. As long as you do not click the link contained in the email, no action will be taken and your account will remain secure. For more information, contact us
	<br>
	<br>
	Thanks,
	<br> 
	<strong> {{ $website_settings->website_name }} </strong><br>
	<strong> {{ $website_settings->contactno }}</strong>

</body>
</html>
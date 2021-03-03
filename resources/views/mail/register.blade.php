@php
    $website_settings=App\WebsiteSetting::where('id','1')->first();
@endphp
<!DOCTYPE html>
<html>
<head>
	<title>{{ $website_settings->website_name }}</title>
</head>
<body>
	Dear <strong>{{ $details['name'] }}</strong>, <br>
	You recently created a new <strong> ESHOP </strong> account. To verify that you own this email address <strong>{{ $details['name'] }}</strong>, simple click on the link below.<br><br>
	<a href="{{ $website_settings->website_url }}/verify/{{ $details['email'] }}/{{ $details['verification_code'] }}"><strong>LINK</strong></a>
	<br>
	<br>
	Verifying your email address ensures that you can securely retrieve your account information if your password is lost or stolen. 
	<br>

	For your security, and in order to get the most value out of your <strong> {{ $website_settings->website_name }} </strong> account,
	please keep your email address information up-to-date.
	If this information changes, you can always update on the Edit Profile page in your <strong> {{ $website_settings->website_name }} </strong> account.<br><br>

	Thanks,
	<br> 
	<strong> {{ $website_settings->website_name }} </strong><br>
	<strong> {{ $website_settings->contactno }}</strong>

</body>
</html>
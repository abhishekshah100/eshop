@include('admin.layouts.header')
<body class="hold-transition login-page">
	@yield('auth_content')
@include('admin.layouts.scripts')
@include('admin.layouts.alertmessage')
</body>
</html>
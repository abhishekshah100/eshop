{{ $output }}
<form action="{{ route('post-palindrome') }}" method="POST">
	@csrf
	<input type="text" name="value" required="">
	<input type="submit" name="submit">
</form>
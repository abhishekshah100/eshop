@if ($message = Session::get('success'))
<script type="text/javascript">
toastr.options.timeOut = 3000; // 1.5s
    toastr.success('{{ $message }}');
</script>
@endif
@if ($message = Session::get('error'))
<script type="text/javascript">
toastr.options.timeOut = 3000; // 1.5s
    toastr.error('{{ $message }}');
</script>
@endif
@if(count($errors)>0)
@foreach($errors->all() as $error)
<script type="text/javascript">
toastr.options.timeOut = 3000; // 1.5s
    toastr.error('{{ $error }}');
</script>
@endforeach
@endif
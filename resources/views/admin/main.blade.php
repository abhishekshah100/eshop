@include('admin.layouts.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.top_nav')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  @include('admin.layouts.side_nav')
  <!-- Content Wrapper. Contains page content -->
	
	@yield('content')

  <!-- /.content-wrapper -->
  @include('admin.layouts.footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('admin.layouts.scripts')
@include('admin.layouts.alertmessage')
</body>
</html>
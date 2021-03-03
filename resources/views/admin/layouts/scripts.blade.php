<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->

<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Select2 -->

<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- Bootstrap4 Duallistbox -->

<script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

<!-- InputMask -->

<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>

<script src="{{ asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

<!-- DataTables -->

<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<!-- date-range-picker -->

<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- bootstrap color picker -->

<script src="{{ asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->

<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Bootstrap Switch -->

<script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<!-- AdminLTE App -->

<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->

<!-- <script src="{{ asset('admin/dist/js/demo.js') }}"></script> -->

 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  $(document).ready(function(){
    $("#delete").click(function(e){
      e.preventDefault();
      var link= $(this).attr('href');
      alert(link);
      // swal({
      //   title: "Are you sure?",
      //   text: "Once deleted, this will be Permanently Delete",
      //   icon: "warning",
      //   buttons: true,
      //   dangerMode: true,
      // })
      // .then((willDelete) => {
      //   if (willDelete) {
      //     window.location.href = link;
      //   } else {
      //     swal("Safe Data");
      //   }
      // });
    });
  });
</script>
@stack('bottom')
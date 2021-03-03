@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Pin Code</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">View All Pin Code</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Pin Code</h3>
              <button type="button" class="btn btn-primary" style="background:#040202; float: right;" data-toggle="modal" data-target="#modal-add">Add New Pincode</button>
              <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><b>Create Pincode</b> </h4>
                  </div>
                  <form  method="POST" action="{{ route('add-pincode') }}">
                    @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pin Code</label>
                          <input type="number" class="form-control" id="addPinCode" name="pincode" placeholder="Pin Code" value="{{ old('pincode') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">City</label>
                          <input type="name" class="form-control" placeholder="City" id="addCity" disabled="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">State</label>
                          <input type="name" class="form-control" placeholder="State" id="addState" disabled="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Country</label>
                          <input type="name" class="form-control" placeholder="Country" id="addCountry" disabled="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Delivery Status</label>
                            <select class="custom-select" name="delivery_status">
                              <option value="">Select Delivery Status</option>
                              <option value="1">Both</option>
                              <option value="2">COD</option>
                              <option value="3">Online Payment</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Delivery in Days</label>
                            <input type="number" class="form-control" name="delivery_in_days" placeholder="Delivery in Days" value="{{ old('delivery_in_days') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Minimum Order</label>
                            <input type="number" class="form-control" name="minimum_order" placeholder="Minimum Order" value="{{ old('minimum_order') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Delivery Charges</label>
                            <input type="number" class="form-control" name="delivery_charges" placeholder="Delivery Charges" value="{{ old('delivery_charges') }}" required>
                        </div>
                      </div>
                      <div class="col-md-6 mt-5">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="pincode_status" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Is Published?</label>
                        </div>
                      </div>
                    </div> 
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <div id="addpincodebutton">
                    </div>
                  </div>
                  </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
              <!-- /.modal-dialog -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Pin Code</th>
                    <th>Delivery Status</th>
                    <th>Delivery in days</th>
                    <th>Minimum Order</th>
                    <th>Delivery Charges</th>
                    <th>Pin Code Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pincodes as $pincode)
                  <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $pincode->pincode }}</th>
                    <th> 
                      @if($pincode->delivery_status=='1')
                        {{ 'Both' }}
                      @elseif($pincode->delivery_status=='2')
                        {{ 'COD' }}
                      @elseif($pincode->delivery_status=='3')
                      {{ 'Online '}}
                      @endif
                    </th>
                    <th>{{ $pincode->delivery_in_days }} {{ $pincode->delivery_in_days=='1'?'day':'days' }}</th>
                    <th>INR {{ $pincode->minimum_order }}</th>
                    <th>INR {{ $pincode->delivery_charges }}</th>
                    <th><span class="badge badge-{{ $pincode->pincode_status==1?'success':'danger' }}">{{ $pincode->pincode_status==1?'Active':'Disable' }}</span></th>
                    <th><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $pincode->id }}"><i class="fas fa-pencil-alt">
                              </i></button>
                      <div class="modal fade" id="modal-edit{{ $pincode->id }}" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title"><b>Edit Pin Code: {{ $pincode->pincode }}</b> </h4>
                            </div>
                            <form  method="POST" action="{{ route('update-pincode', $pincode->id) }}">
                              @csrf
                              @method('PATCH')
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Pin Code</label>
                                      <input type="number" class="form-control pincodeID" id="editPinCode{{ $pincode->id }}" name="pincode" placeholder="Pin Code" value="{{ $pincode->pincode }}" data-pincode="{{ $pincode->id }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">City</label>
                                      <input type="name" class="form-control" placeholder="City" id="editCity{{ $pincode->id }}" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">State</label>
                                      <input type="name" class="form-control" placeholder="State" id="editState{{ $pincode->id }}" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Country</label>
                                      <input type="name" class="form-control" placeholder="Country" id="editCountry{{ $pincode->id }}" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Status</label>
                                        <select class="custom-select" name="delivery_status">
                                          <option value="">Select Delivery Status</option>
                                          <option value="1"{{ $pincode->delivery_status=='1'?'selected':'' }}>Both</option>
                                          <option value="2"{{ $pincode->delivery_status=='2'?'selected':'' }}>COD</option>
                                          <option value="3"{{ $pincode->delivery_status=='3'?'selected':'' }}>Online Payment</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery in Days</label>
                                        <input type="number" class="form-control" name="delivery_in_days" placeholder="Delivery in Days" value="{{ $pincode->delivery_in_days }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Minimum Order</label>
                                        <input type="number" class="form-control" name="minimum_order" placeholder="Minimum Order" value="{{ $pincode->minimum_order }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Charges</label>
                                        <input type="number" class="form-control" name="delivery_charges" placeholder="Delivery Charges" value="{{ $pincode->delivery_charges }}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6 mt-5">
                                    <div class="form-check">
                                      <input type="checkbox" class="form-check-input" name="pincode_status" id="exampleCheck1" {{ $pincode->pincode_status=='1'?'checked':'' }}>
                                      <label class="form-check-label" for="exampleCheck1">Is Published?</label>
                                    </div>
                                  </div>
                                </div> 
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Pincode</button>
                              </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                      <!-- /.modal-dialog -->
                      </div>
                      @if($pincode->pincode_status=='1')
                        <a href="{{ route('pincode.status', $pincode->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Pincode Inactive"><i class="far fa-thumbs-down"></i></i></a>
                      @elseif($pincode->pincode_status=='2')
                        <a href="{{ route('pincode.status', $pincode->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Pincode Active"><i class="far fa-thumbs-up"></i></a>
                      @endif
                      <form method="POST" action="{{ route('delete-pincode', $pincode->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this pincode?');"><i class="fas fa-trash"></i></button>
                      </form></th>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.N.</th>
                    <th>Pin Code</th>
                    <th>Delivery Status</th>
                    <th>Delivery in days</th>
                    <th>Minimum Order</th>
                    <th>Delivery Charges</th>
                    <th>Pin Code Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
@endsection
@push('bottom')
<script>
$(document).ready(function(){
    $("#addPinCode").change(function(){
      var pincode=$('#addPinCode').val();
      $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
      if(pincode==''){
          $('#addCity').val('');
          $('#addState').val('');
          $('#addpincodebutton').html('');
        }else{
          $.ajax({
            url: "{{ route('pincode-api') }}",
            type : "GET",
            data : { pincode : pincode },
            success: function(data){
              if(data=='no'){
                alert('Wrong Pincode');
                $('#addCity').val('');
                $('#addState').val('');
                $('#addpincodebutton').html('');
              }else{
                var getData=$.parseJSON(data);
                $('#addCity').val(getData.city);
                $('#addState').val(getData.state);
                $('#addCountry').val(getData.country);
                $('#addpincodebutton').html('<button type="submit" class="btn btn-primary">Create Pincode</button>');
              }
            }
          }) 
        }
    });
    $('.pincodeID').click(function(){
      var pincode_id = $(this).data("pincode");
      $("#editPinCode"+pincode_id).change(function(){
        var pincode=$(this).val();
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        if(pincode==''){
          $('#editCity'+pincode_id).val('');
          $('#editState'+pincode_id).val('');
        }else{
          $.ajax({
            url: "{{ route('pincode-api') }}",
            type : "GET",
            data : { pincode : pincode },
            success: function(data){
              if(data=='no'){
                alert('Wrong Pincode');
                $('#editCity'+pincode_id).val('');
                $('#editState'+pincode_id).val('');
              }else{
                var getData=$.parseJSON(data);
                $('#editCity'+pincode_id).val(getData.city);
                $('#editState'+pincode_id).val(getData.state);
                $('#editCountry'+pincode_id).val(getData.country);
              }
            }
          }) 
        }
        });
    });
  });
</script>
@endpush
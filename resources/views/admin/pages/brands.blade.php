@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background:#040202;">
                <h3 class="card-title">Create Brand</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Brand Name</label>
                    <input type="name" class="form-control" value="{{ old('brandname') }}" name="brandname" id="exampleInputEmail1" placeholder="Brand Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Title</label>
                    <input type="name" class="form-control" name="metatitle" value="{{ old('metatitle') }}" id="exampleInputEmail1" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Keywords</label>
                    <textarea class="form-control" name="metakeywords" id="exampleInputEmail1" placeholder="Meta Keywords">{{ old('metakeywords') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Description</label>
                    <textarea class="form-control" name="metadescription" id="exampleInputEmail1" placeholder="Meta Description">{{ old('metadescription') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Canonical</label>
                    <input type="text" class="form-control" value="{{ old('metacanonical') }}" name="metacanonical" id="exampleInputEmail1" placeholder="Meta Canonical">
                  </div>
                  <div class="form-group">
                        <label>Brand Status*</label>
                          <select class="custom-select" name="brand_status">
                            <option value="">Select Brand Status</option>
                              <option value="1" {{ old('brand_status')=='1'?'selected':''  }}>Active</option>
                              <option value="2" {{ old('brand_status')=='2'?'selected':''  }}>Disable</option>
                          </select>
                  </div>
                  <div class="form-group">
                        <label for="customFile">Brand Logo</label>
                        <div class="custom-file">
                          <input type="file" id="filePhoto" class="custom-file-input" id="customFile" name="brand_logo" onchange="preview()">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                  </div>
                   <img id="showImage" src="" width="120" height="120" style="display: none;" />
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="insert_brand" class="btn btn-primary" style="background:#040202">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
		  <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Brand</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Brand Logo</th>
                  <th>Brand Name</th>
                  <th>Brand Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
					@foreach ($brand as $brands)
						<tr>
						  <td>{{ $loop->iteration }}</td>
						  <td><img src="../{{ $brands->brand_logo }}" width="195" height="70"></td>
              <td>{{ $brands->brandname }}</td>
              <td><span class="badge badge-{{ $brands->brand_status==1?'success':'danger' }}">{{ $brands->brand_status==1?'Active':'Disable' }}</span></td>
						  <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-view{{ $brands->id }}"><i class="fas fa-eye"></i></a>
						    <div class="modal fade" id="modal-view{{ $brands->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><b>View Brand</b> : {{ $brands->brandname }}</h4>
								</div>
								<div class="modal-body">
								  <div class="form-group">
										<label for="exampleInputEmail1">Brand Name</label> : {{ $brands->brandname }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Title</label> : {{ $brands->metatitle }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Slug</label> : {{ $brands->slug }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Keywords</label> : {{ $brands->metakeywords }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Description</label> : {{ $brands->metadescription }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Canonical</label> : {{ $brands->metacanonical }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Brand Status</label> : {{ $brands->brand_status=='1'?'Active':'Disable' }}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Brand Logo</label> : <img src="../{{ $brands->brand_logo }}" width="120" height="120">
                  </div>
									<!-- /.card-body --> 
								</div>
								<div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
								</div>
							  </div>
							  <!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						  </div>
						  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $brands->id }}"><i class="fas fa-pencil-alt">
                              </i></a>
						  <div class="modal fade" id="modal-edit{{ $brands->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><b>Update Brand</b> : {{ $brands->brandname }}</h4>
								</div>
								<form role="form" method="POST" action="{{ route('brand.update',$brands->id) }}" enctype="multipart/form-data">
									@csrf
        							@method('PATCH')
								<div class="modal-body">
								  <div class="form-group">
										<label for="exampleInputEmail1">Brand Name</label>
										<input type="name" class="form-control" name="brandname" id="exampleInputEmail1" placeholder="Brand Name" value="{{ $brands->brandname }}" required>
								  </div>
								  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Title</label>
				                    <input type="name" class="form-control" name="metatitle" id="exampleInputEmail1" placeholder="Meta Title" value="{{ $brands->metatitle }}" required>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Keywords</label>
				                    <textarea class="form-control" name="metakeywords" id="exampleInputEmail1" placeholder="Meta Keywords" required>{{ $brands->metakeywords }}</textarea>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Description</label>
				                    <textarea class="form-control" name="metadescription" id="exampleInputEmail1" placeholder="Meta Description" required>{{ $brands->metadescription }}</textarea>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Canonical</label>
				                    <input type="text" class="form-control" name="metacanonical" id="exampleInputEmail1" placeholder="Meta Canonical" value="{{ $brands->metacanonical }}" required>
				                  </div>
                          <div class="form-group">
                            <label>Brand Status*</label>
                              <select class="custom-select" name="brand_status">
                                <option value="">Select Brand Status</option>
                                  <option value="1" {{ $brands->brand_status=='1'?'selected':'' }}>Active</option>
                                  <option value="2" {{ $brands->brand_status=='2'?'selected':'' }}>Disable</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Brand Logo*</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="brand_logo" onchange="editPreview({{ $brands->id }})">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                          </div>
                          <img src="../{{ $brands->brand_logo }}" width="120" height="120" id="editImage{{ $brands->id }}">
									<!-- /.card-body --> 
								</div>
								<div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
								  <button type="submit" class="btn btn-primary" name="edit_brand">Update Brand</button>
								</div>
								</form>
							  </div>
							  <!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						  </div>
              @if($brands->brand_status=='1')
                <a href="{{ route('brand.status', $brands->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Brand Inactive"><i class="far fa-thumbs-down"></i></i></a>
              @elseif($brands->brand_status=='2')
                <a href="{{ route('brand.status', $brands->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Brand Active"><i class="far fa-thumbs-up"></i></a>
              @endif
              <form method="POST" action="{{ route('brand.destroy', $brands->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this brand?');"><i class="fas fa-trash" data-toggle="tooltip" title="Delete Brand"></i></button>
              </form>
						</td>
					</tr>
					@endforeach
				</tbody>
                <tfoot>
                <tr>
                  <th>S.N.</th>
                  <th>Brand Logo</th>
                  <th>Brand Name</th>
                  <th>Brand Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
  @endsection
  @push('bottom')
  <script>
    function preview() {
        showImage.src=URL.createObjectURL(event.target.files[0]);
        $("#showImage").show();
    }
  </script>
  @endpush
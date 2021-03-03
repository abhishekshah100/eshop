@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Sub Category</li>
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
                <h3 class="card-title">Create Sub Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('sub_category.store') }}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                        <label>Category Name*</label>
                          <select class="custom-select" name="category_id">
                            <option value="">Select Category Name</option>
                            @foreach($category as $categories)
                              <option value="{{ $categories->id }}" {{ old('category_id')==$categories->id?'selected':'' }} >{{ $categories->categoryname }}</option>
                            @endforeach
                          </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Name</label>
                    <input type="name" class="form-control" name="sub_categoryname" placeholder="Sub Category Name" value="{{ old('sub_categoryname') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Title</label>
                    <input type="name" class="form-control" name="metatitle" value="{{ old('metatitle') }}" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Keywords</label>
                    <textarea class="form-control" name="metakeywords" placeholder="Meta Keywords">{{ old('metakeywords') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Description</label>
                    <textarea class="form-control" name="metadescription" placeholder="Meta Description">{{ old('metadescription') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Canonical</label>
                    <input type="text" class="form-control" name="metacanonical" placeholder="Meta Canonical" value="{{ old('metacanonical') }}">
                  </div>
                  <div class="form-group">
                        <label>Sub Category Status*</label>
                          <select class="custom-select" name="sub_category_status">
                            <option value="">Select Sub Category Status</option>
                              <option value="1" {{ old('sub_category_status')=='1'?'selected':'' }}>Active</option>
                              <option value="2" {{ old('sub_category_status')=='2'?'selected':'' }}>Disable</option>
                          </select>
                  </div>
                  <div class="form-group">
                        <label for="customFile">Sub Category Image</label>
                        <div class="custom-file">
                          <input type="file" id="filePhoto" class="custom-file-input" id="customFile" name="sub_category_image" onchange="preview()">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                  </div>
                   <img id="showImage" src="" width="120" height="120" style="display: none;" />
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="insert_category" class="btn btn-primary" style="background:#040202">Submit</button>
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
              <h3 class="card-title">All Sub Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Sub Category Image</th>
                  <th>Category Name</th>
                  <th>Sub Category Name</th>
                  <th>Sub Category Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
					@foreach ($subcategory as $sub_categories)
						<tr>
						  <td>{{ $loop->iteration }}</td>
              <td><img src="../{{ $sub_categories->sub_category_image }}" width="120" height="120"></td>
              <td>{{ $sub_categories->category->categoryname  }}</td>
						  <td>{{ $sub_categories->sub_categoryname }}</td>
              <td><span class="badge badge-{{ $sub_categories->sub_category_status==1?'success':'danger' }}">{{ $sub_categories->sub_category_status==1?'Active':'Disable' }}</span></td>
						  <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-view{{ $sub_categories->id }}"><i class="fas fa-eye"></i></a>
						    <div class="modal fade" id="modal-view{{ $sub_categories->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><b>View Category</b> : {{ $sub_categories->sub_categoryname }}</h4>
								</div>
								<div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label> : {{ $sub_categories->category->categoryname }}
                  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Sub Category Name</label> : {{ $sub_categories->sub_categoryname }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Title</label> : {{ $sub_categories->metatitle }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Slug</label> : {{ $sub_categories->slug }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Keywords</label> : {{ $sub_categories->metakeywords }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Description</label> : {{ $sub_categories->metadescription }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Canonical</label> : {{ $sub_categories->metacanonical }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Status</label> : {{ $sub_categories->sub_category_status=='1'?'Active':'Disable' }}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Image</label> : <img src="../{{ $sub_categories->sub_category_image }}" width="120" height="120">
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
						  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $sub_categories->id }}"><i class="fas fa-pencil-alt">
                              </i></a>
						  <div class="modal fade" id="modal-edit{{ $sub_categories->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><b>Update Sub Category</b> : {{ $sub_categories->sub_categoryname }}</h4>
								</div>
								<form  method="POST" action="{{ route('sub_category.update',$sub_categories->id) }}" enctype="multipart/form-data">
									@csrf
        							@method('PATCH')
								<div class="modal-body">
                  <div class="form-group">
                        <label>Category Name*</label>
                          <select class="custom-select" name="category_id">
                            <option value="">Select Category Name</option>
                            @foreach($category as $categories)
                              <option value="{{ $categories->id }}" {{ $sub_categories->category_id==$categories->id?'selected':'' }} >{{ $categories->categoryname }}</option>
                            @endforeach
                          </select>
                  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Sub Category Name</label>
										<input type="name" class="form-control" name="sub_categoryname" placeholder="Sub Category Name" value="{{ $sub_categories->sub_categoryname }}" required>
								  </div>
								  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Title</label>
				                    <input type="name" class="form-control" name="metatitle" placeholder="Meta Title" value="{{ $sub_categories->metatitle }}" required>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Keywords</label>
				                    <textarea class="form-control" name="metakeywords" placeholder="Meta Keywords" required>{{ $sub_categories->metakeywords }}</textarea>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Description</label>
				                    <textarea class="form-control" name="metadescription" placeholder="Meta Description" required>{{ $sub_categories->metadescription }}</textarea>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Canonical</label>
				                    <input type="text" class="form-control" name="metacanonical" placeholder="Meta Canonical" value="{{ $sub_categories->metacanonical }}" required>
				                  </div>
                          <div class="form-group">
                          <label>Sub Category Status*</label>
                            <select class="custom-select" name="sub_category_status">
                              <option value="">Select Sub Category Status</option>
                                <option value="1" {{ $sub_categories->sub_category_status==1?'selected':'' }}>Active</option>
                                <option value="2" {{ $sub_categories->sub_category_status==2?'selected':'' }}>Disable</option>
                            </select>
                          </div>
                          <div class="form-group">
                              <label>Sub Category Image*</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="sub_category_image" onchange="editPreview({{ $sub_categories->id }})">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                          </div>
                          <img src="../{{ $sub_categories->sub_category_image }}" width="120" height="120" id="editImage{{ $sub_categories->id }}">
									<!-- /.card-body --> 
								</div>
								<div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
								  <button type="submit" class="btn btn-primary" name="edit_category">Update Sub Category</button>
								</div>
								</form>
							  </div>
							  <!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						  </div>
              @if($sub_categories->sub_category_status=='1')
                <a href="{{ route('sub_category.status', $sub_categories->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Sub Category Inactive"><i class="far fa-thumbs-down"></i></i></a>
              @elseif($sub_categories->sub_category_status=='2')
                <a href="{{ route('sub_category.status', $sub_categories->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Sub Category Active"><i class="far fa-thumbs-up"></i></a>
              @endif
						  <form method="POST" action="{{ route('sub_category.destroy', $sub_categories->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this sub category?');"><i class="fas fa-trash" data-toggle="tooltip" title="Delete Category"></i></button>
              </form>
						</td>
					</tr>
					@endforeach
				</tbody>
                <tfoot>
                <tr>
                  <th>S.N.</th>
                  <th>Sub Category Image</th>
                  <th>Category Name</th>
                  <th>Sub Category Name</th>
                  <th>Sub Category Status</th>
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
  <!-- DataTables -->
  @endsection
  @push('bottom')
  <script>
    function preview() {
        showImage.src=URL.createObjectURL(event.target.files[0]);
        $("#showImage").show();
    }
  </script>
  @endpush
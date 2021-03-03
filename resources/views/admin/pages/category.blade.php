@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title">Create Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="name" class="form-control" name="categoryname" placeholder="Category Name" value="{{ old('categoryname') }}">
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
                        <label>Category Status*</label>
                          <select class="custom-select" name="category_status">
                            <option value="">Select Category Status</option>
                              <option value="1" {{ old('category_status')=='1'?'selected':'' }}>Active</option>
                              <option value="2" {{ old('category_status')=='2'?'selected':'' }}>Disable</option>
                          </select>
                  </div>
                  <div class="form-group">
                        <label for="customFile">Category Image</label>
                        <div class="custom-file">
                          <input type="file" id="filePhoto" class="custom-file-input" id="customFile" name="category_image" onchange="preview()">
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
              <h3 class="card-title">All Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Category Image</th>
                  <th>Category Name</th>
                  <th>Category Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
					@foreach ($category as $categories)
						<tr>
						  <td>{{ $loop->iteration }}</td>
              <td><img src="../{{ $categories->category_image }}" width="120" height="120"></td>
						  <td>{{ $categories->categoryname }}</td>
              <td><span class="badge badge-{{ $categories->category_status==1?'success':'danger' }}">{{ $categories->category_status==1?'Active':'Disable' }}</span></td>
						  <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-view{{ $categories->id }}"><i class="fas fa-eye"></i></a>
						    <div class="modal fade" id="modal-view{{ $categories->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><b>View Category</b> : {{ $categories->categoryname }}</h4>
								</div>
								<div class="modal-body">
								  <div class="form-group">
										<label for="exampleInputEmail1">Category Name</label> : {{ $categories->categoryname }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Title</label> : {{ $categories->metatitle }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Slug</label> : {{ $categories->slug }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Keywords</label> : {{ $categories->metakeywords }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Description</label> : {{ $categories->metadescription }}
								  </div>
								  <div class="form-group">
										<label for="exampleInputEmail1">Meta Canonical</label> : {{ $categories->metacanonical }}
								  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Status</label> : {{ $categories->category_status=='1'?'Active':'Disable' }}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Image</label> : <img src="../{{ $categories->category_image }}" width="120" height="120">
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
						  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $categories->id }}"><i class="fas fa-pencil-alt">
                              </i></a>
						  <div class="modal fade" id="modal-edit{{ $categories->id }}" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title"><b>Update Category</b> : {{ $categories->categoryname }}</h4>
								</div>
								<form  method="POST" action="{{ route('category.update',$categories->id) }}" enctype="multipart/form-data">
									@csrf
        							@method('PATCH')
								<div class="modal-body">
								  <div class="form-group">
										<label for="exampleInputEmail1">Category Name</label>
										<input type="name" class="form-control" name="categoryname" placeholder="Category Name" value="{{ $categories->categoryname }}" required>
								  </div>
								  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Title</label>
				                    <input type="name" class="form-control" name="metatitle" placeholder="Meta Title" value="{{ $categories->metatitle }}" required>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Keywords</label>
				                    <textarea class="form-control" name="metakeywords" placeholder="Meta Keywords" required>{{ $categories->metakeywords }}</textarea>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Description</label>
				                    <textarea class="form-control" name="metadescription" placeholder="Meta Description" required>{{ $categories->metadescription }}</textarea>
				                  </div>
				                  <div class="form-group">
				                    <label for="exampleInputEmail1">Meta Canonical</label>
				                    <input type="text" class="form-control" name="metacanonical" placeholder="Meta Canonical" value="{{ $categories->metacanonical }}" required>
				                  </div>
                          <div class="form-group">
                          <label>Category Status*</label>
                            <select class="custom-select" name="category_status">
                              <option value="">Select Category Status</option>
                                <option value="1" {{ $categories->category_status==1?'selected':'' }}>Active</option>
                                <option value="2" {{ $categories->category_status==2?'selected':'' }}>Disable</option>
                            </select>
                          </div>
                          <div class="form-group">
                              <label>Category Image*</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="category_image" onchange="editPreview({{ $categories->id }})">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                          </div>
                          <img src="../{{ $categories->category_image }}" width="120" height="120" id="editImage{{ $categories->id }}">
									<!-- /.card-body --> 
								</div>
								<div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
								  <button type="submit" class="btn btn-primary" name="edit_category">Update Category</button>
								</div>
								</form>
							  </div>
							  <!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						  </div>
              @if($categories->category_status=='1')
                <a href="{{ route('category.status', $categories->id ) }}" class="btn btn-danger" data-toggle="tooltip" title="Make Category Inactive"><i class="far fa-thumbs-down"></i></i></a>
              @elseif($categories->category_status=='2')
                <a href="{{ route('category.status', $categories->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Make Category Active"><i class="far fa-thumbs-up"></i></a>
              @endif
						  <form method="POST" action="{{ route('category.destroy', $categories->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this category?');"><i class="fas fa-trash" data-toggle="tooltip" title="Delete Category"></i></button>
              </form>
						</td>
					</tr>
					@endforeach
				</tbody>
                <tfoot>
                <tr>
                  <th>S.N.</th>
                  <th>Category Image</th>
                  <th>Category Name</th>
                  <th>Category Status</th>
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
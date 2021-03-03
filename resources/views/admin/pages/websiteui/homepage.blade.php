@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Website UI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="color:#111;">Dashboard</a></li>
              <li class="breadcrumb-item active">Home Page UI</li>
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
          <div class="col-12 col-sm-12 col-lg-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1" style="background:#040202;">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Slider</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Premium  Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Popular Categories</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Offer Banners</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- /.card-header -->
                  <a href="#" class="btn btn-info mb-3" data-toggle="modal" data-target="#modal-add">Add New Slider</a>

                  <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"><b>Create New Slider</b></h4>
                      </div>
                      <form role="form" method="POST" action="{{ url('admin/addslider') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Main Heading</label>
                          <input type="name" class="form-control" name="main_heading" id="exampleInputEmail1" placeholder="Main Heading" value="" required>
                        </div>
                        <div class="form-group">
                                  <label for="exampleInputEmail1">Sub Heading</label>
                                  <input type="name" class="form-control" name="sub_heading" id="exampleInputEmail1" placeholder="Sub Heading" value="" required>
                        </div>
                        <div class="form-group">
                                  <label for="exampleInputEmail1">Sub Sub Heading</label>
                                  <input type="name" class="form-control" name="sub_sub_heading" id="exampleInputEmail1" placeholder="Sub Sub Heading" value="" required>
                        </div>
                        <div class="form-group">
                                  <label for="exampleInputEmail1">Slider link</label>
                                  <input type="name" class="form-control" name="slider_link" id="exampleInputEmail1" placeholder="Slider Link" value="" required>
                        </div>
                        <div class="form-group">
                                  <label for="exampleInputEmail1">Slider Image :  </label>
                                  <input type="file" name="slider_image"  required>
                        </div>
                        <p><b>*Recommended Image size: 1920px x 610px</b> </p>
                        <div class="form-group">
                                  <label>Slider Status*</label>
                                    <select class="custom-select" name="slider_status">
                                      <option value="">Select Slider Status</option>
                                        <option value="1" selected="">Active</option>
                                        <option value="2" >Disable</option>
                                    </select>
                        </div>
                        <!-- /.card-body --> 
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_slider">Create Slider Now</button>
                      </div>
                      </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Main Heading</th>
                            <th>Sub Heading</th>
                            <th>Sub Sub Heading</th>
                            <th>Link</th>
                            <th>Images</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($home_sliders as $home_slider)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $home_slider->main_heading }}</td>
                            <td>{{ $home_slider->sub_heading }}</td>
                            <td>{{ $home_slider->sub_sub_heading }}</td>
                            <td><a href="{{ $home_slider->link }}" target="_blank">{{ $home_slider->link }}</a></td>
                            <td><a href="../{{ $home_slider->slider_image }}" target="_blank"><img src="../{{ $home_slider->slider_image }}" width="100"></a></td>
                            <td><span class="badge badge-{{ $home_slider->status==1?'success':'danger' }} px-2 py-2">{{ $home_slider->status==1?'Active':'Inactive' }}</span></td>
                            <td>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $home_slider->id }}"><i class="fas fa-pencil-alt"></i></a>

                            <div class="modal fade" id="modal-edit{{ $home_slider->id }}" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title"><b>Update Slider: </b> {{ $home_slider->main_heading }}</h4>
                                </div>
                                <form role="form" method="POST" action="/admin/editslider/{{$home_slider->id }}" enctype="multipart/form-data">
                                  @csrf
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Main Heading</label>
                                    <input type="name" class="form-control" name="main_heading" id="exampleInputEmail1" placeholder="Main Heading" value="{{ $home_slider->main_heading }}" required>
                                  </div>
                                  <div class="form-group">
                                            <label for="exampleInputEmail1">Sub Heading</label>
                                            <input type="name" class="form-control" name="sub_heading" id="exampleInputEmail1" placeholder="Sub Heading" value="{{ $home_slider->sub_heading }}" required>
                                  </div>
                                  <div class="form-group">
                                            <label for="exampleInputEmail1">Sub Sub Heading</label>
                                            <input type="name" class="form-control" name="sub_sub_heading" id="exampleInputEmail1" placeholder="Sub Sub Heading" value="{{ $home_slider->sub_sub_heading }}" required>
                                  </div>
                                  <div class="form-group">
                                            <label for="exampleInputEmail1">Slider link</label>
                                            <input type="name" class="form-control" name="slider_link" id="exampleInputEmail1" placeholder="Slider Link" value="{{ $home_slider->link }}" required>
                                  </div>
                                  <div class="form-group">
                                            <label for="exampleInputEmail1">Slider Image :  </label><br>
                                            <input type="file" name="slider_image">
                                            <img src="../{{ $home_slider->slider_image }}" width="100">
                                  </div>
                                  <p><b>*Recommended Image size: 1920px x 610px</b> </p>
                                  <div class="form-group">
                                            <label>Slider Status*</label>
                                              <select class="custom-select" name="slider_status">
                                                <option value="">Select Slider Status</option>
                                                  <option value="1" {{ $home_slider->status==1?'selected':'' }}>Active</option>
                                                  <option value="2" {{ $home_slider->status==2?'selected':'' }}>Disable</option>
                                              </select>
                                  </div>
                                  <!-- /.card-body --> 
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="update_slider">Update Slider Now</button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <a href="{{ route('admin-delete-homeslider', $home_slider->id ) }}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>S.N.</th>
                            <th>Heading 1</th>
                            <th>Heading 2</th>
                            <th>Heading 3</th>
                            <th>Link</th>
                            <th>Images</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                     <div class="table-responsive">
                      <table id="example3" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Link</th>
                            <th>Images</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @for($i=0;$i<3;$i++)
                          <tr>
                            <td>{{ $i+1 }}</td>
                            <td><a href="{{ $array_premium_link[$i] }}" target="_blank">{{ $array_premium_link[$i] }}</a></td>
                            <td><a href="../{{ $array_premium_images[$i] }}" target="_blank"><img src="../{{ $array_premium_images[$i] }}" width="100"></a></td>
                            <td>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit-premium{{ $i }}"><i class="fas fa-pencil-alt"></i></a>

                            <div class="modal fade" id="modal-edit-premium{{ $i }}" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title"><b>Update Premium Product </b></h4>
                                </div>
                                <form role="form" method="POST" action="/admin/editpremiumproduct/{{ $i }}" enctype="multipart/form-data">
                                  @csrf
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Image* </label>
                                    <br>
                                    <input type="file" name="premium_product_image">
                                    <img src="../{{ $array_premium_images[$i] }}" width="100">
                                  </div>
                                  <p><b>*Recommended Image size: 450px x 300px </b></p>
                                  <div class="form-group">
                                            <label for="exampleInputEmail1">Link*</label>
                                            <input type="name" class="form-control" name="premium_product_link"  placeholder="Link" value="{{ $array_premium_link[$i] }}" required>
                                  </div>
                                  <!-- /.card-body --> 
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="update_premium_product">Update Premium Product</button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          </tr>
                          @endfor
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>S.N.</th>
                            <th>Link</th>
                            <th>Images</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                     <div class="table-responsive">
                      <table id="example3" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Images</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td><a href="../{{ $popular_category->websiteui_images }}" target="_blank"><img src="../{{ $popular_category->websiteui_images }}" width="100"></a></td>
                            <td>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit-category"><i class="fas fa-pencil-alt"></i></a>

                            <div class="modal fade" id="modal-edit-category" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title"><b>Update Popular Category </b></h4>
                                </div>
                                <form role="form" method="POST" action="/admin/editcategoryproduct" enctype="multipart/form-data">
                                  @csrf
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Image* </label>
                                    <br>
                                    <input type="file" name="popular_category_image">
                                    <img src="../{{ $popular_category->websiteui_images }}" width="100">
                                  </div>
                                  <p><b>*Recommended Image size: 1920px x 885px </b></p>
                                  <!-- /.card-body --> 
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="update_premium_product">Update Category Image</button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>S.N.</th>
                            <th>Images</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     <div class="table-responsive">
                      <table id="example5" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Link</th>
                            <th>Images</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @for($j=0;$j<2;$j++)
                          <tr>
                            <td>{{ $j+1 }}</td>
                            <td><a href="{{ $array_offer_banners_link[$j] }}" target="_blank">{{ $array_offer_banners_link[$j] }}</a></td>
                            <td><a href="../{{ $array_offer_banners_images[$j] }}" target="_blank"><img src="../{{ $array_offer_banners_images[$j] }}" width="100"></a></td>
                            <td>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-edit-offer{{ $j }}"><i class="fas fa-pencil-alt"></i></a>

                            <div class="modal fade" id="modal-edit-offer{{ $j }}" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title"><b>Update Offer Banner </b></h4>
                                </div>
                                <form role="form" method="POST" action="/admin/editofferbanners/{{ $j }}" enctype="multipart/form-data">
                                  @csrf
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label>Image* </label>
                                    <br>
                                    <input type="file" name="offer_banners_image">
                                    <img src="../{{ $array_offer_banners_images[$j] }}" width="100">
                                  </div>
                                  <p><b>*Recommended Image size: 690px x 225px </b></p>
                                  <div class="form-group">
                                            <label for="exampleInputEmail1">Link*</label>
                                            <input type="name" class="form-control" name="offer_banners_link"  placeholder="Offer Banner Link" value="{{ $array_offer_banners_link[$j] }}" required>
                                  </div>
                                  <!-- /.card-body --> 
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="update_offer_banner">Update Offer Banner</button>
                                </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          </td>
                          </tr>
                          @endfor
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>S.N.</th>
                            <th>Link</th>
                            <th>Images</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
  </section>
  </div>
@endsection
@push('bottom')
<script>
  $(function () {
    $("#example3").DataTable();
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

  $(function () {
    $("#example5").DataTable();
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
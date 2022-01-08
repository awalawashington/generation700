@extends('Layouts.Admin.app')
@section('content')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  @include('Layouts.Admin.Includes.preloader')

  <!-- Navbar -->
  @include('Layouts.Admin.Includes.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('Layouts.Admin.Includes.left-side-bar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CMS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CMS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Content Management</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-pencil-alt mr-1"></i> Banner</strong>

                <p class="text-muted">
                  Its the very top of the landing page
                </p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> About</strong>

                <p class="text-muted">Its next after banner</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Portfolio</strong>

                <p class="text-muted">Its the section in between the about us and journal</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Social Media</strong>

                <p class="text-muted">These are the social media handles</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
              @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endforeach
                @endif

                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Banner</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Portfolio Cat</a></li>
                  <li class="nav-item"><a class="nav-link" href="#portfolio" data-toggle="tab">Portfolio</a></li>
                  <li class="nav-item"><a class="nav-link" href="#social_media" data-toggle="tab">Social Media</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <form class="form-horizontal" action="{{ route('admin.banner.update_image',[$banner->id]) }}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf
                      @method('PUT')
                      <img src="{{asset('storage/uploads/banners/original/'.$banner->image)}}" class="offset-sm-2 col-sm-10 mb-2" style="max-height:100px; max-width:200px;">
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-camera"></i> Image
                            <input type="file" name="image">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update Image</button>
                        </div>
                      </div>
                    </form>

                    <form class="form-horizontal" action="{{ route('admin.banner.update',[$banner->id]) }}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf
                      @method('PUT')
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="title" value="{{$banner->title}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" name="description">{{$banner->description}}</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <form class="form-horizontal" action="{{ route('admin.about.update_image',[$about->id]) }}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf
                      @method('PUT')
                      <img src="{{asset('storage/uploads/abouts/original/'.$about->image)}}" class="offset-sm-2 col-sm-10 mb-2" style="max-height:100px; max-width:200px;">
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-camera"></i> Image
                            <input type="file" name="image">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update Image</button>
                        </div>
                      </div>
                    </form>

                    <form class="form-horizontal" action="{{ route('admin.about.update',[$about->id]) }}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf
                      @method('PUT')
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="title" value="{{$about->title}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" name="description">{{$about->description}}</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="{{ route('admin.portfolio_category.create')}}" method="post">
                      @csrf
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Add Portfolio Category</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="name">
                        </div>
                        <div class="col-sm-2">
                          <button type="submit" class="btn btn-secondary">Add</button>
                        </div>
                      </div>
                    </form>

                    @foreach($portfolio_categories as $portfolio_category)
                    <form class="form-horizontal" action="{{ route('admin.portfolio_category.update',[$portfolio_category->id])}}" method="post" >
                      @csrf
                      @method('PUT')
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Edit {{$portfolio_category->name}}</label>
                          <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="name" value="{{$portfolio_category->name}}">
                          </div>
                          <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                            
                    </form>
                    <form action="{{ route('admin.portfolio_category.delete',[$portfolio_category->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </div>
                    </form>
                    @endforeach

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="portfolio">
                    <form class="rounded border p-3 mb-5" action="{{ route('admin.portfolio.create')}}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" name="portfolio_category_id">
                          <option value="" class="form-control" id="inputName">Select Category</option>
                            @foreach($portfolio_categories as $portfolio_category)
                                <option value="{{$portfolio_category->id}}" class="form-control" id="inputName">{{$portfolio_category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-camera"></i> Image
                            <input type="file" name="image">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="title" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" name="description"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                    </form>

                    @foreach($portfolio_categories as $portfolios)
                    @foreach($portfolios->portfolios as $portfolio)
                    <form class="form-horizontal mt-3 border-top pt-3" action="{{ route('admin.portfolio.update_image',[$portfolio->id])}}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf
                      @method('PUT')
                      <img src="{{asset('storage/uploads/portfolios/original/'.$portfolio->image)}}" class="offset-sm-2 col-sm-10 mb-2" style="max-height:100px; max-width:200px;">
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-camera"></i> Image
                            <input type="file" name="image">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary">Update Image</button>
                        </div>
                      </div>
                    </form>

                    <form class="form-horizontal mb-3" action="{{ route('admin.portfolio.update',[$portfolio->id])}}" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control select2bs4" name="portfolio_category_id">
                            <option value="{{$portfolio->portfolio_category_id}}">{{$portfolio->portfolio_category->name}}</option>
                              @foreach($portfolio_categories as $portfolio_category)
                                  <option value="{{$portfolio_category->id}}" class="form-control" id="inputName">{{$portfolio_category->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="title" value="{{$about->title}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" name="description">{{$about->description}}</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                      </div>
                    </form>
                    <form action="{{ route('admin.portfolio.delete',[$portfolio->id])}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-block">Delete</button>
                      </form>
                    @endforeach
                    @endforeach

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="social_media">
                    <form class="form-horizontal" action="{{ route('admin.social_media.update',[$social_media->id]) }}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Facebook</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="facebook" value="{{$social_media->facebook}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Twitter</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="twitter" value="{{$social_media->twitter}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Instagram</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="instagram" value="{{$social_media->instagram}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">LinkedIn</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="linked_in" value="{{$social_media->linked_in}}">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('Layouts.Admin.Includes.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('Layouts.Admin.Includes.js')
@endsection




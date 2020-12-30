@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Tables</a>
      <span class="breadcrumb-item active">Data Table</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Update Brand </h6>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{route('update.brand', $brand->id)}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="formGroupExampleInput">Brand Name</label>
                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="brand" value="{{$brand->brand_name}}">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Brand Logo</label>
                <input type="file" class="form-control" id="brand_logo" name="brand_logo" placeholder="brand">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput"><strong>OLD LOGO:</strong> </label>
                <img src="{{URL::to($brand->brand_logo)}}" alt=""style="height:60px; width:90px;">
                <input type="hidden" class="form-control" id="old_logo" name="old_logo" value="{{$brand->brand_logo}}">
              </div>

              
              <button type="submit" class="btn btn-info text-center">Update Category</button>
            </div>          
          </form>
          </div>
        </div>
      </div>

@endsection();
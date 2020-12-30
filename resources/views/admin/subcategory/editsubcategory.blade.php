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
        <h6 class="card-body-title">Update Sub Category </h6>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{route('update.subcategory', $subcategory->id)}}">
              @csrf
              <div class="form-group">
                <label for="formGroupExampleInput">Sub Category Name</label>
                <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="subcategory" value="{{$subcategory->subcategory_name}}">
              </div>

              <div class="form-group">
                <label for="formGroupExampleInput">Category</label>
                  <select class="form-control" name="category_id">
                      @foreach ($category as $row)
                          <option value="{{$row->id}}" <?php if($row->id == $subcategory->category_id){ echo "selected";} ?>>{{$row->category_name}}</option>
                      @endforeach
                  </select>
                </div>
              
              <button type="submit" class="btn btn-info text-center">Update SubCategory</button>
            </div>          
          </form>
          </div>
        </div>
      </div>

@endsection();
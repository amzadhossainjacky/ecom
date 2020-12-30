@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Tables</a>
      <span class="breadcrumb-item active">Data Table</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Sub Category Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Sub Category List
            <a href="#" style="float: right;" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#examplemodal" >Add New</a>
        </h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p"> Category Name</th>
                <th class="wd-15p">Sub Category Name</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($subcategory as $row)
                  <tr>
                    <td>{{$row->category_name}}</td>
                    <td>{{$row->subcategory_name}}</td>
                    <td>
                        <a href="{{route('edit.subcategory', $row->id)}}" class="btn btn-sm btn-info"> Edit </a>
                        <a href="{{route('delete.subcategory', $row->id)}}" class="btn btn-sm btn-danger" id="delete"> Delete </a>
                    </td>
                  </tr>
              @endforeach

            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

      {{-- modal --}}

      <!-- LARGE MODAL -->
      <div id="examplemodal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Sub Category Create</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{route('store.subCategory')}}">
              @csrf
            <div class="modal-body pd-20">
              <div class="form-group">
                <label for="formGroupExampleInput">Sub Category Name</label>
                <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="sub category">
              </div>

              <div class="form-group">
              <label for="formGroupExampleInput">Category</label>
                <select class="form-control" name="category_id">
                    @foreach ($category as $row)
                        <option value="{{$row->id}}">{{$row->category_name}}</option>
                    @endforeach
                </select>
              </div>
            </div>

            <!-- modal-body -->
              
            <div class="modal-footer">
              <button type="submit" class="btn btn-info text-center">Add Sub Category</button>
            </div>
          
          </form>
          </div>
        </div><!-- modal-dialog -->
      </div><!-- modal -->

@endsection();
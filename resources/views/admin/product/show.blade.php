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
        <h5>Product Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p"> Product Title</th>
                <th class="wd-15p"> Product Image</th>
                <th class="wd-15p"> Category</th>
                <th class="wd-15p"> Quantity</th>
                <th class="wd-15p"> Status</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($products as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->product_title}}</td>
                    <td> <img src="{{URL::to($row->image_one)}}" alt="" style="height:40px; width:40px; "></td>
                    <td>{{$row->category_name}}</td>
                    <td>{{$row->product_quantity}}</td>
                    <td>
                        @if ($row->status ==1)
                            <span class="badge badge-success">active</span>
                        @else
                            <span class="badge badge-danger">inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('edit.product', $row->id)}}" class="btn btn-sm btn-primary" title="Edit"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('delete.product', $row->id)}}" class="btn btn-sm btn-danger" title="Delete"> <i class="fa fa-trash"></i> </a>
                        <a href="{{route('view.product', $row->id)}}" class="btn btn-sm btn-warning" title="View"> <i class="fa fa-eye"></i> </a>

                        @if ($row->status == 1)
                            <a href="{{route('inactive.product', $row->id)}}" class="btn btn-sm btn-danger"  title="Inactive"> <i class="fa fa-thumbs-down"></i> </a>
                        @else
                            <a href="{{route('active.product', $row->id)}}" class="btn btn-sm btn-success"  title="Active"> <i class="fa fa-thumbs-up"></i> </a>
                         @endif
                        
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
              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Brand Create</h6>
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

            <form method="POST" action="{{route('store.brand')}}" enctype="multipart/form-data">
              @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                  <label for="formGroupExampleInput">Brand Name</label>
                  <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="brand">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput">Brand Logo</label>
                  <input type="file" class="form-control" id="brand_logo" name="brand_logo" placeholder="brand logo">
                </div>
            </div><!-- modal-body -->
              
            <div class="modal-footer">
              <button type="submit" class="btn btn-info text-center">Add Brand</button>
            </div>
          
          </form>
          </div>
        </div><!-- modal-dialog -->
      </div><!-- modal -->

@endsection();
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
        <h5>Newsletters Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Subscribe List
            <a href="#" style="float: right;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#examplemodal" >Delete All</a>
        </h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p"> Subscribed email</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($newsletter as $row)
                  <tr>
                    <td> <input type="checkbox" class="mr-2">{{$row->id}}</td>
                    <td>{{$row->email}}</td>
                    <td>
                        <a href="{{route('delete.newsletter', $row->id)}}" class="btn btn-sm btn-danger" id="delete"> Delete </a>
                    </td>
                  </tr>
              @endforeach

            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

@endsection();
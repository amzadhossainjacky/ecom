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
        <h6 class="card-body-title">Update Coupon </h6>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{route('update.coupon', $coupon->id)}}">
              @csrf
              <div class="form-group">
                <label for="formGroupExampleInput"> Coupon Code</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="coupon" value="{{$coupon->coupon_code}}">
              </div>

              <div class="form-group">
                <label for="formGroupExampleInput">Discount (%)</label>
                <input type="text" class="form-control" id="discount" name="discount" placeholder="discount" value="{{$coupon->discount}}">
              </div>
              <button type="submit" class="btn btn-info text-center">Update Coupon</button>
            </div>          
          </form>
          </div>
        </div>
      </div>

@endsection();
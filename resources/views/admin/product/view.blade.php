@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->

<div class="sl-mainpanel">

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product Section <a href="{{route('all.product')}}" class="btn btn-success btn-sm pull-right">All Product</a></h6>
            <h2 class="mg-b-20 mg-sm-b-30">Product Details</h2>
                  
            <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Product Title: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->product_title}}</strong>
                </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->product_code}}</strong>
                </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->product_quantity}}</strong>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Category:<span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->category_name}}</strong>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->subcategory_name}}</strong>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->brand_name}}</strong>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->product_size}}</strong>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->product_color}}</strong>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                      <br>
                        <strong>{{$product->selling_price}}</strong>
                    </div>
                </div><!-- col-4 -->
                {{-- product details --}}

                <div class="col-lg-12">
                    <div class="form-group" style="border: 3px solid; padding: 10px;">
                    <label class="form-control-label">Product Details<span class="tx-danger">*</span></label>
                    <br>
                    <strong>{!! $product->product_details !!}</strong>
                  </div>	
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Video Link<span class="tx-danger">*</span></label>
                    <br>
                    <strong>{{$product->video_link}}</strong>
                  </div>	
                </div>

                <div class="col-lg-4 mt-2">
                    <lebel>Image One (Main Thumbnail)<span class="tx-danger">*</span></lebel>
                    <br>
                    <label class="custom-file">
                        <img src="{{URL::to($product->image_one)}}" style="height: 50px; width:50px" id="one" >
                        </label>

                </div>
                <div class="col-lg-4 mt-2">
                    <lebel>Image Two <span class="tx-danger">*</span></lebel>
                    <br>
                    <label class="custom-file">
                        <img src="{{URL::to($product->image_two)}}" style="height: 50px; width:50px" id="two" >
                        </label>
                </div>
                <div class="col-lg-4 mt-2">
                    <lebel>Image Three <span class="tx-danger">*</span></lebel>
                    <br>
                    <label class="custom-file">
                        <img src="{{URL::to($product->image_three)}}" style="height: 50px; width:50px" id="three" >
                        </label>
                </div>
            </div><!-- row -->

           {{--  check box --}}

            <br><hr>
            <div class="row align-item-center">
            	<div class="col-lg-4 ">
            		<label>
                        @if ($product->main_slider == 1)
                            <span class=" badge badge-success">active</span>
                            <strong>Main Slider</strong>
                        @else
                            <span class=" badge badge-danger">inactive</span>
                            <strong>Main Slider</strong>
                        @endif
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label>
                        @if ($product->hot_deal == 1)
                        <span class=" badge badge-success">active</span>
                        <strong>Hot Deal</strong>
                    @else
                        <span class=" badge badge-danger">inactive</span>
                        <strong>Hot Deal</strong>
                    @endif
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label >
                        @if ($product->best_rated == 1)
                        <span class=" badge badge-success">active</span>
                        <strong>Best Rated</strong>
                        @else
                        <span class=" badge badge-danger">inactive</span>
                        <strong>Best Rated</strong>
                         @endif
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label >
                        @if ($product->trend == 1)
                        <span class=" badge badge-success">active</span>
                        <strong>Trend</strong>
                        @else
                        <span class=" badge badge-danger">inactive</span>
                        <strong>Trend</strong>
                         @endif
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label >
                        @if ($product->mid_slider == 1)
                        <span class=" badge badge-success">active</span>
                        <strong>Mid Slider</strong>
                        @else
                        <span class=" badge badge-danger">inactive</span>
                        <strong>Mid Slider</strong>
                         @endif
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label >
                        @if ($product->hot_new == 1)
                        <span class=" badge badge-success">active</span>
                        <strong>Hot New</strong>
                        @else
                        <span class=" badge badge-danger">inactive</span>
                        <strong>Hot New</strong>
                         @endif
      				</label>
            	</div>
            <br><br><hr>
            
          </div><!-- form-layout -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->
@endsection

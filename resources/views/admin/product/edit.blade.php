@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Ecom</a>
      <span class="breadcrumb-item active">Add Product</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h2 class="mg-b-20 mg-sm-b-30">Edit Product </h2>
            <form action="{{route('update.product.withoutimage', $product->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  
            <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Product Title: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_title" placeholder="Enter product title" value="{{$product->product_title}}">
                </div>
                </div><!-- col-4 -->
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_code" placeholder="Enter product code" value="{{$product->product_code}}">
                </div>
                </div><!-- col-4 -->
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_quantity" placeholder="product quantity" value="{{$product->product_quantity}}">
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Category:<span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                        <option label="Choose category"></option>
                        @foreach ($category as $row)
                        <option value="{{$row->id}}" <?php if ($row->id == $product->category_id) {
                            echo "selected";} ?>>{{$row->category_name}}</option>
                        @endforeach   
                    </select>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose subcategory"  name="subcategory_id">

                      {{-- data comes through ajax --}}
                      <option label="Choose Sub Category"></option>
                        @foreach ($subcategory as $row)
                        <option value="{{$row->id}}" <?php if ($row->id == $product->subcategory_id) {
                            echo "selected";} ?>>{{$row->subcategory_name}}</option>
                        @endforeach  
                      
                    </select>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Brand"  name="brand_id">
                        <option label="Choose brand"></option>
                        @foreach ($brand as $row)
                          <option value="{{$row->id}}" <?php if ($row->id == $product->brand_id) {
                          echo "selected";} ?>>{{$row->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label><br>
                      <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" value="{{$product->product_size}}">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label><br>
                      <input class="form-control lg-4" type="text" name="product_color" data-role="tagsinput" id="color" value="{{$product->product_color}}">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="selling_price"  placeholder="Selling Price" value="{{$product->selling_price}}">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Discount Price <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="discount_price"  placeholder="discount" value="{{$product->discount_price}}">
                  </div>
              </div><!-- col-4 -->
                {{-- product details --}}

                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="form-control-label">Product Details<span class="tx-danger">*</span></label>
                     <textarea class="form-control" id="summernote" name="product_details">
                        {!! $product->product_details !!}
                     </textarea>
                  </div>	
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Video Link<span class="tx-danger">*</span></label>
                     <input class="form-control" placeholder="video link" name="video_link" value="{{$product->video_link}}">
                  </div>	
                </div>

                
            </div><!-- row -->

           {{--  check box --}}

            <br><hr>
            <div class="row">
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="main_slider" value="1" <?php if ($product->main_slider == 1) {
                        echo "checked";} ?> >
					  <span>Main Slider</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="hot_deal" value="1" <?php if ($product->hot_deal == 1) {
                        echo "checked";} ?>>
					  <span>Hot Deal</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="best_rated" value="1" <?php if ($product->best_rated == 1) {
                        echo "checked";} ?>>
					  <span>Best Rated</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="trend" value="1" <?php if ($product->trend == 1) {
                        echo "checked";} ?>>
					  <span>Trend Product</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
					  <input type="checkbox" name="mid_slider" value="1" <?php if ($product->mid_slider == 1) {
                        echo "checked";} ?>>
					  <span>Mid Slider</span>
					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
      					  <input type="checkbox" name="hot_new" value="1" <?php if ($product->hot_new == 1) {
                            echo "checked";} ?>>
      					  <span>Hot New</span>
      					</label>
            	</div>
             
            <br><br><hr>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Upadte Product </button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->
                     
        <br><br><hr>
    </div><!-- sl-pagebody -->

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
                <form action="{{route('update.product.image', $product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <lebel>Image One (Main Thumbnail)<span class="tx-danger">*</span></lebel>
                            <br>
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);" accept="image">
                                <span class="custom-file-control"></span><br>
                                <img src="#" id="one" >
                                <input type="hidden" name="old_one" value="{{$product->image_one}}">
                            </label>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <img src="{{URL::to($product->image_one)}}" height="60px" width="50px" alt="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <lebel>Image Two <span class="tx-danger">*</span></lebel>
                            <br>
                            <label class="custom-file">
                                  <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL1(this);"  accept="image">
                                  <span class="custom-file-control"></span>
                                  <br>
                                  <img src="#" id="two" >
                                  <input type="hidden" name="old_two" value="{{$product->image_two}}">
                                </label>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <img src="{{URL::to($product->image_two)}}" height="60px" width="50px" alt="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <lebel>Image Three <span class="tx-danger">*</span></lebel>
                            <br>
                            <label class="custom-file">
                                  <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL2(this);" accept="image">
                                  <span class="custom-file-control"></span><br>
                                  <img src="#" id="three" >
                                  <input type="hidden" name="old_three" value="{{$product->image_three}}">
                            </label>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <img src="{{URL::to($product->image_three)}}" height="60px" width="50px" alt="">
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-info">Update Image</button>
                </form>
            </div>
        </div>
  </div><!-- sl-mainpanel -->

  <!-- ########## END: MAIN PANEL ########## -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
  </script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>

  <script type="text/javascript">
	  $(document).ready(function() {
         $('select[name="category_id"]').on('change', function(){
             var category_id = $(this).val();
             if(category_id) {
                 $.ajax({
                     url: "{{  url('/get/subcategory/') }}/"+category_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        var d =$('select[name="subcategory_id"]').empty();
                           $.each(data, function(key, value){
                               $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');
                           });
                     },                  
                 });
             } else {
                 alert('danger');
             }

         });
     });

</script>

<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>

<script type="text/javascript">
	function readURL1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#two')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>

<script type="text/javascript">
	function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#three')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection

@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css')}}">

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 "  style="border-right: 1px solid grey; padding: 20px;">
                    <div class="cart_container">
                    	<div class="contact_form_title text-center">Total</div>
					
						<ul class="list-group col-lg-6 mt-4" style="margin: 0 auto;">
							  @if(Session::has('coupon'))
							       <li class="list-group-item">Subtotal :  <span style="float: right;"> $ {{ number_format(Session::get('coupon')['balance'], 2,".",",") }}</span> </li>
							        <li class="list-group-item">Coupon : ({{   Session::get('coupon')['name'] }}) <a href="{{route('remove.coupon')}}" class="btn btn-danger btn-sm">x</a> <span style="float: right;">  {{ Session::get('coupon')['discount']}} %</span> </li>
							  	@else
							  	  <li class="list-group-item">Subtotal :  <span style="float: right;"> $ {{ Cart::subtotal() }}</span> </li>
							  	@endif
							  
                                @if (Cart::subtotal() == 0)
                                    <li class="list-group-item">Shipping Charge: <span style="float: right;"> $ 0</span></li>  
                                @else
                                    <li class="list-group-item">Shipping Charge: <span style="float: right;"> $ {{ $charge }}</span></li>  
                                @endif
							    
                                <li class="list-group-item">Vat :  <span style="float: right;">$ 0</span></li>
                                
                              @if(Session::has('coupon'))
                                @php
                                    $total =Session::get('coupon')['balance'] + $charge
                                @endphp
                                <li class="list-group-item">Total:  <span style="float: right;"> $ {{ number_format($total, 2,".",",") }}</span> </li>
                                
                              @else
                                    @php
                                        $subtotal = str_replace( ',', '', Cart::subtotal());
                                    @endphp
                                    @if (Cart::subtotal()==0)
                                        <li class="list-group-item">Total:  <span style="float: right;">$ 0 </span> </li> 
                                    @else
                                        <li class="list-group-item">Total:  <span style="float: right;">$ {{ number_format($subtotal  + $charge, 2,".",",")  }} </span> </li> 
                                    @endif
							  @endif
						</ul>
					</div>
                </div>

                 <div class="col-lg-5 " style=" padding: 20px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Shipping Address</div>

                        <form action="{{route('paymentType')}}" id="contact_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name </label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Full Name " name="name" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" class="form-control " name="phone"  aria-describedby="emailHelp" placeholder="Phone "  required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" class="form-control " name="email"   aria-describedby="emailHelp" placeholder="Email " required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="address" name="address" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="city" name="city" required="">
                            </div>
                            <div class="contact_form_title text-center">Payment By</div>
                           <div class="form-group">
                                <ul class="logos_list " >
                                            <li><input type="radio" name="paymentType" value="stripe"> <img src="{{ asset('public/frontend/images/mastercard.png') }}" style="width: 100px; height: 60px;"></li>
                                            <li><input type="radio" name="paymentType" value="paypal"> <img src="{{ asset('public/frontend/images/paypal.png') }}" style="width: 100px;"></li>
                                             <li><input type="radio" name="paymentType" value="ideal"> <img src="{{ asset('public/frontend/images/mollie.png') }}" style="width: 100px; height: 80px;"></li>
                                             <li><input type="radio" name="paymentType" value="cash" ><strong class="ml-3">Cash </strong></li>
                                 </ul>
                            </div><br>
                            <div class="contact_form_button text-center">
                                <button type="submit" class="btn btn-info">Pay Now</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

@endsection

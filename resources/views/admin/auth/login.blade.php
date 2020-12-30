@extends('admin.admin_layouts')

{{-- @section('admin_content')
        <div class="wrapper without_header_sidebar">
            <!-- contnet wrapper -->
            <div class="content_wrapper">
                    <!-- page content -->
                    <div class="login_page center_container">
                        <div class="center_content">
                            <div class="logo">
                                <img src="{{asset('public/panel/assets/images/logo.png')}}" alt="" class="img-fluid">
                            </div>
                            <form action="" class="d-block" method="post">
                                @csrf
                                <div class="form-group icon_parent">
                                    <label for="email">E-mail</label>
                                    
                                </div>
                                <div class="form-group icon_parent">
                                    <label for="password">Password</label>
                                    
                                    <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="chech_container">Remember me
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.password.request') }}" class="text-white">I forgot my password</a>
                                    <button type="submit" class="btn btn-blue">Login</button>
                                </div>
                            </form>
                            <div class="footer">
                                <p>Copyright &copy; 2019 <a href="https://durbarit.com/">Durbar IT</a>. All rights reserved.</p>
                            </div>
                            
                        </div>
                    </div>
            </div><!--/ content wrapper -->
        </div><!--/ wrapper -->
@endsection --}}


@section('admin_login_content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
    
    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin</div>
      <div class="tx-center mg-b-60">Ecommerce Website</div>

      <form action="{{route('admin.login')}}" method="post">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div><!-- form-group -->
        <div class="form-group">
            <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">Sign In</button>
      </form>

      </div><!-- login-wrapper -->
     </div><!-- d-flex -->

@endsection


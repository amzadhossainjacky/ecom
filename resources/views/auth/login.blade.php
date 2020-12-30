@extends('layouts.app')

@section('content')
        {{-- <div class="wrapper without_header_sidebar">
            <!-- contnet wrapper -->
            <div class="content_wrapper">
                    <!-- page content -->
                    <div class="login_page center_container">
                        <div class="center_content">
                            <div class="logo">
                                <img src="{{asset('public/panel/assets/images/logo.png')}}" alt="" class="img-fluid">
                            </div>
                            <form action="{{route('login')}}" class="d-block" method="post">
                                @csrf
                                <div class="form-group icon_parent">
                                    <label for="email">E-mail</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                    <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>
                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                                </div>
                                <div class="form-group icon_parent">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="chech_container">Remember me
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <a class="registration" href="{{route('register')}}">Create new account</a><br>
                                    <a href="{{ route('password.request') }}" class="text-white">I forgot my password</a>
                                    <button type="submit" class="btn btn-blue">Login</button>
                                </div>
                            </form>
                            <div class="footer">
                                <p>Copyright &copy; 2019 <a href="https://durbarit.com/">Durbar IT</a>. All rights reserved.</p>
                            </div>
                            
                        </div>
                    </div>
            </div><!--/ content wrapper -->
        </div><!--/ wrapper --> --}}

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 my-5">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <h2 class="text-info"> SIGN IN</h2>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email or Phone</label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail1" placeholder="email or phone" required>

                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="password" name="password" required>

                          @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>

                        <a href="{{ route('password.request') }}" class="text-primary">I forgot my password</a><br><br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <br> <br>
                        <button class="btn btn-primary"> Login With Facebook</button><br><br>
                        <button class="btn btn-danger"> Login With Google</button>
                      </form>
                </div>
            </div>
        </div>
@endsection

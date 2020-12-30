@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="col-lg-4">
            <div class="card text-center" style="width: 18rem;">
                <img src="{{asset('public/backend/img/profile.jpg')}}" class="card-img-top w-50 m-auto rounded-circle pt-3" alt="">
                <div class="card-body">
                  <h5 class="card-title">{{Auth::User()->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><a href="{{route('password.change')}}">Password Change</a></li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                  <div class="p-2">
                    <a href="{{route('user.logout')}}" class="btn btn-danger d-block">Logout</a>
                  </div>
              </div>
        </div>
    </div>
</div>
@endsection

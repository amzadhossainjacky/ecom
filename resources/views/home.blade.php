@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-sm-12 ">
            <table class="table responsive">
                <thead>
                  <tr>
                    <th scope="col">Payment Type</th>
                    <th scope="col">Payment ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status Code</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $row)
                    <tr>
                      <th>{{$row->payment_type}}</th>
                      <td>{{$row->payment_id}}</td>
                      <td>$ {{$row->total}}</td>
                      <td>{{$row->date}}</td>
                      <td>{{$row->status_code}}</td>
                      <td>
                        @if($row->status == 0)
                        <span class="badge badge-warning">Pending</span>
                        @elseif($row->status == 1)
                        <span class="badge badge-info">Accept</span>
                        @elseif($row->status == 2) 
                        <span class="badge badge-info">Progress </span>
                        @elseif($row->status == 3)  
                        <span class="badge badge-success">Delivered </span>
                        @else
                        <span class="badge badge-danger">Cancel </span>
                        @endif
                      </td>
                      <td>
                        <a href="{{route('user.view.order', $row->id)}}" class="btn btn-sm btn-info">view</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
        <div class="col-lg-3">
            <div class="card text-center" style="width: 18rem;">
                <img src="{{asset('public/backend/img/profile.jpg')}}" class="card-img-top w-50 m-auto rounded-circle pt-3" alt="">
                <div class="card-body">
                  <h5 class="card-title">{{Auth::User()->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><a href="{{route('password.change')}}">Password Change</a></li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item"><a href="{{route('return.order.list')}}">Return Order</a></li>
                </ul>
                  <div class="p-2">
                    <a href="{{route('user.logout')}}" class="btn btn-danger d-block">Logout</a>
                  </div>
              </div>
        </div>
    </div>
</div>
@endsection

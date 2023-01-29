@extends('layouts.app')
@section('content')
<x-dashboard-header  mainpage="Orders" subpage="My Orders"></x-dashboard-header>

<div class="container pb-5 mb-2 mb-md-4">
  <div class="row">
      @include('user.includes.sidebar')
      <section class="col-lg-8">
        <div class="modal fade" id="order-details">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" id="o-detail">

            </div>
          </div>
      </div>
      <!-- Toolbar-->

      <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
        <h6 class="fs-base text-light mb-0">All Orders:</h6>

      </div>
      <div class="table-responsive fs-md mb-4">

        @if ($orders->count() != 0)

          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Date Purchased</th>
                <th>Status</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr>
                <td class="py-3">
                  <a class="nav-link-style fw-medium fs-sm order-det" href="#order-details" data-route="{{route('user.order.detail' , $order->id)}}" data-bs-toggle="modal">{{$order->order_number}}</a>
                </td>
                <td class="py-3">
                  {{$order->getCreatedAtAttribute($order->created_at)}}
                </td>
                @php
                    if($order->status == "pending" )
                      $class ="bg-warning";
                    elseif($order->status == "dispatched")
                    $class ="bg-info";
                    elseif($order->status == "cancelled")
                    $class ="bg-danger";
                    elseif($order->status == "approved" || $order->status == "delivered")
                    $class ="bg-success";
                @endphp
                <td class="py-3"><span class="badge {{$class}} m-0">{{$order->status}}</span></td>
                <td class="py-3">R. {{$order->amount}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        {!! $orders->links() !!}

        @else
        <div class="text-center">

          <h3 class="text-danger">No Orders Found</h3>
          <img width="200px" src="{{asset(env('PUBLIC_PATH' , '')."img/sad.png") }}"/>
        </div>
        @endif
      </div>
      </section>
  </div>
</div>
@endsection

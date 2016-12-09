@extends("layouts.account")

@section("content")
  <style>
  .items{ list-style-type: none;padding-left:0;margin-top:10px;margin-bottom:10px;}
  .info{padding:10px;}
  </style>
  <div class="col-lg-12">
    <div class="col-lg-6">
      <h3>My Recent Orders</h3>
      <div class="orders">
        @foreach(Order::getRecent() as $order)

          <div class="order col-lg-12">
            <ul class="items">
              @foreach($order->getItems() as $item)
                <li><img src="{!! $item->getImg() !!}" width="45px" height="45px"> {!! $item->getTitle() !!}</li>
              @endforeach
            </ul>
            <p>{!! $order->getDate() !!}</p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-lg-6 info">
      <h3>My Account Information</h3
      <p><strong>Name:</strong> {!! $user->first_name . " " . $user->last_name !!}</p>
      <p><strong>Email:</strong> {!! $user->email !!}</p>
      <p><a href="{!! url("account/edit") !!}" class="btn btn-info">Edit Info</a></p>
    </div>
  </div>
@endSection

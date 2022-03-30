@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">  
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-10 offset-2 mt-5">
            <div class="col-md-9">
              <a href="{{ route('admin#pizza') }}"><button class="btn btn-dark btn-sm mb-3"><i class="fas fa-arrow-left"></i>  Back</button></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Pizza Information</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex justify-content-around" id="activity">
                        <div class="mt-4">
                            <img  class="img-thumbnail rounded" src="{{ asset('uploads/'.$pizza->image) }}">
                        </div>
                        <div class="">
                            <div class="mt-3">
                                <b>Name</b> : <span>{{ $pizza->pizza_name }}</span>
                            </div>
                            <div class="mt-3">
                                <b>Price</b> : <span>{{ $pizza->price }}</span>
                            </div>
                            <div class="mt-3">
                                <b>Public Status</b> : 
                                <span>
                                    @if ($pizza->publish_status == 1)
                                        Yes
                                    @else
                                            No                                   
                                    @endif
                                </span>
                            </div>
                            <div class="mt-3">
                                <b>Category</b> : <span>{{ $pizza->category_id }}</span>
                            </div>
                            <div class="mt-3">
                                <b>Discount</b> : <span>{{ $pizza->discount_price }} Kyats</span>
                            </div>
                            <div class="mt-3">
                                <b>Buy one get one Status</b> : 
                                <span>
                                    @if ($pizza->buy_one_get_one_status == 1)
                                        Yes
                                    @else
                                        No                                   
                                    @endif
                                </span>
                            </div>
                            <div class="mt-3">
                                <b>Waiting Time</b> : <span>{{ $pizza->waiting_time }}</span>
                            </div>
                            <div class="mt-3">
                                <b>Description</b> : <span>{{ $pizza->description }}</span>
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@endsection
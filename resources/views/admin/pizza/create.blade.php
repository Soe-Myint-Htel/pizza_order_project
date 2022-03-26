@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">  
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <a href="{{ route('admin#pizza') }}"><button class="btn btn-dark btn-sm mb-3"><i class="fas fa-arrow-left"></i>  Back</button></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Add New Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#createCategory') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="Name" name="name">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control"  placeholder="Image" name="imgae">
                              @if ($errors->has('image'))
                                  <p class="text-danger">{{ $errors->first('image') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Pirce" pirce="pirce">
                              @if ($errors->has('pirce'))
                                  <p class="text-danger">{{ $errors->first('pirce') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Public status</label>
                            <div class="col-sm-10">
                              <select name="publish" class="form-control">
                                  <option value="1">Publish</option>
                                  <option value="0">Unpublish</option>
                              </select>
                              @if ($errors->has('publish'))
                                  <p class="text-danger">{{ $errors->first('publish') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Catrgory</label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control">
                                    <option value="1">...</option>
                                    <option value="0">123</option>
                                </select>
                              @if ($errors->has('category'))
                                  <p class="text-danger">{{ $errors->first('category') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Discount" name="discount">
                              @if ($errors->has('discount'))
                                  <p class="text-danger">{{ $errors->first('discount') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                            <div class="col-sm-10">
                                <select name="buyOneGetOne" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                              @if ($errors->has('buyOneGetOne'))
                                  <p class="text-danger">{{ $errors->first('buyOneGetOne') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Waiting time" name="waitingTime">
                              @if ($errors->has('waitingTime'))
                                  <p class="text-danger">{{ $errors->first('waitingTime') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" name="description" rows="3"></textarea>
                              @if ($errors->has('description'))
                                  <p class="text-danger">{{ $errors->first('description') }}</p>
                              @endif
                            </div>
                          </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white float-end">Add</button>
                          </div>
                        </div>
                      </form>
                      
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
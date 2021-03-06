@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- success alert --}}
        @if (Session::has('successPizza'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ Session::get('successPizza') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- delete alert --}}
        @if (Session::has('deletePizza'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ Session::get('deletePizza') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- update alert --}}
        @if (Session::has('updatePizza'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ Session::get('updatePizza') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin#createPizza') }}">
                  <button class="btn btn-dark"><i class="fas fa-plus me-2"></i>Add Pizza</button>
                </a>
                <span class="badge rounded-pill bg-success fs-5 ms-3 mt-1">Total - {{ $pizza->total() }}</span>

                <div class="card-tools d-flex">
                  <a href="{{ route('admin#pizzaDownload') }}">
                    <buttom class="btn btn-sm btn-success mt-1 me-4">Download CSV</buttom></a>
                  <form action="{{ route('admin#searchPizza') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm mt-1" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($status == 0)
                        <tr>
                          <td colspan="7">
                            <p>There is no data...</p>
                          </td>
                        </tr>
                    @else
                      @foreach ($pizza as $item)
                      <tr>
                        <td>{{ $item->pizza_id }}</td>
                        <td>{{ $item->pizza_name }}</td>
                        <td>
                          <img src="{{ asset('uploads/'.$item->image) }}" class="img-thumbnail" width="100px">
                        </td>
                        <td>{{ $item->price }} kyats</td>
                        <td>
                          @if ($item->public_status == 1)
                              Publish
                          @elseif ($item->public_status == 0)
                              Unpublish
                          @endif
                        </td>
                        <td>
                          @if ($item->buy_one_get_one_status == 1)
                              Yes
                          @elseif ($item->buy_one_get_one_status == 0)
                              No
                          @endif
                        </td>
                        <td>
                          <a href="{{ route('admin#editPizza', $item->pizza_id) }}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                          </a>
                          <a href="{{ route('admin#deletePizza',$item->pizza_id) }}">
                            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                          </a>
                          <a href="{{ route('admin#infoPizza', $item->pizza_id) }}">
                            <button class="btn btn-sm bg-primary text-white"><i class="fas fa-eye"></i></button>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
                {{ $pizza->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
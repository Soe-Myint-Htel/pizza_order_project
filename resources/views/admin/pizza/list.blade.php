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
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin#createPizza') }}">
                  <button class="btn btn-dark"><i class="fas fa-plus me-2"></i>Add Pizza</button>
                </a>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
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
                    @foreach ($pizza as $item)
                    <tr>
                      <td>{{ $item->pizza_id }}</td>
                      <td>{{ $item->pizza_name }}</td>
                      <td>
                        <img src="https://st.depositphotos.com/1003814/5052/i/950/depositphotos_50523105-stock-photo-pizza-with-tomatoes.jpg" class="img-thumbnail" width="100px">
                      </td>
                      <td>{{ $item->price }} kyats</td>
                      <td>
                        @if ($item->publish_status == 1)
                            Publish
                        @elseif ($item->publish_status == 0)
                            Unpublish
                        @endif
                      </td>
                      <td>
                        @if ($item->buy_one_get_one == 1)
                            Yes
                        @elseif ($item->buy_one_get_one == 0)
                            No
                        @endif
                      </td>
                      <td>
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        <a href="{{ route('admin#deletePizza',$item->pizza_id) }}">
                          <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                        </a>
                      </td>
                    </tr>
                    @endforeach
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
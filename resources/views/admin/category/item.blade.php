@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
              <h4>{{ $pizza[0]->categroyName }}</h4>
            <div class="card">
              <div class="card-header">
                  <span class="badge rounded-pill bg-success fs-5 ms-3 mt-1">Total - {{ $pizza->total() }}</span>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Pizza Name</th>
                      <th>Price Count</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pizza as $item)
                    <tr>
                      <td>{{$item->pizza_id}}</td>
                      <td class="w-25 h-25">
                          <img src="{{ asset('uploads/'.$item->image) }}" class="w-50 h-50">
                      </td>
                      <td>{{$item->pizza_name}}</td>
                      <td>{{ $item->price }}</td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="mt-3 ms-5">{{ $pizza->links() }}</div>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <a href="{{ route('admin#category') }}">
                    <button class="btn btn-dark"><< Back</button>
                </a>
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- success alert --}}
        @if (Session::has('successCategory'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ Session::get('successCategory') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- delete alert--}}
        @if (Session::has('successDelete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ Session::get('successDelete') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- update alert--}}
        @if (Session::has('successUpdate'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ Session::get('successUpdate') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('admin#addCategory') }}">
                    <button class="btn btn-sm btn-outline-dark mt-1">Add Category</button>
                  </a>
                </h3>
                  <span class="badge rounded-pill bg-success fs-5 ms-3 mt-1">Total - {{ $category->total() }}</span>
                <div class="card-tools">
                  <form action="{{ route('admin#searchCategory') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm mt-2" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ old('search') }}">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Product Count</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($category as $item)
                    <tr>
                      <td>{{$item->category_id}}</td>
                      <td>{{$item->category_name}}</td>
                      <td>{{ $item->count }}</td>
                      <td>
                        <a href="{{ route('admin#editCategory', $item->category_id) }}">
                          <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>
                        <a href="{{ route('admin#deleteCategory', $item->category_id)}}">
                          <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="mt-3 ms-5">{{ $category->links() }}</div>
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
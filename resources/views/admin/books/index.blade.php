@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('books.create')}}" class="btn btn-success">Add</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Author</th>
                  <th>Page</th>
                  <th>Made in</th>
                  <th>Year</th>
                  <th>Is Hadr</th>
                  <th>Кind</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Discont</th>
                  <th>Price-%</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                <tr>
                  <td>{{$book->id}}</td>
                  <td>{{$book->name}}</td>
                  <td>{{$book->author_name}}</td>
                  <td>{{$book->page}}</td>
                  <td>{{$book->autor}}</td>
                  <td>{{$book->year}}</td>
                  <td>{{$book->is_hadr}}</td>
                  <td>{{$book->kindof}}</td>
                  <td>{{$book->size}}</td>
                  <td>{{$book->price}}</td>
                  <td>
                    <img src="{{$book->getImage()}}" alt="" width="100">
                  </td>
                  @if($book->author->status_discont_id == 1)
                  @if($book->discont_global > $book->author->discont_id)
                  <td>{{$book->discont_global}}</td>
                  <td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
                  @else
                  <td>{{$book->author->discont_id}}</td>
                  <td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
                  @endif
                  @endif
                  <td>{{$book->status}}</td>
                  
                  <td>
                  <a href="{{route('books.edit', $book->id)}}" class="fa fa-pencil"></a> 

                  {{Form::open(['route'=>['books.destroy', $book->id], 'method'=>'delete'])}}
	                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">
	                   <i class="fa fa-remove"></i>
	                  </button>
                  {{ link_to_route('books.show', 'info', [$book->id], ['class' => 'btn btn-success btn-xs']) }}
	                   {{Form::close()}}
                  </td>
                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@extends('homes.layout')

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
                <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('home.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> Back
            </a>
              </div>
              @if(Auth::check())
                    <div class="leave-comment"><!--leave comment-->
             
               

                  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Paid</th>
                  <th>Add</th>
                  <th>Del</th>
                  <th>Order</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Quantity</th>
                  <th>Summa</th>
                  <th>%id or %gl</th>
                  <th>Price-%</th>
                  <th>Item</th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                  <td>
                   @foreach($purchases as $purchase) 
                   @if($purchase->status_paied == 1)
                  
                    <button class="btn send-btn"><a href="" class="fa fa-thumbs-o-up"></a></button>
                    </form> 
                  @else
                      <a href="" class="fa fa-lock"></a> 
                  @endif
              </td>
              <td>
                  @if($purchase->status_bought == 1)
                  
                    <button class="btn send-btn"><a href="purchases/toggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a></button>
                    </form> 
                  @else
                      <a href="purchases/toggle/{{$purchase->id}}" class="fa fa-lock"></a> 
                  @endif
              </td>
              <td>
                  {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>
                       {{Form::close()}}
                </td>    
                @if($purchase->book_id != null)
                   <td>{{($purchase->order_id)}}</td>
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->first()->book->name}}
                  </td>
                  <td>{{$purchase->first()->book->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td> 
                  <td> 
                 @if(Auth::check())  
                 {!! Form::model($purchase, ['route' => ['purchases.update', $purchase->id], 'method' => 'PUT']) !!}
                  {{--Form::open([
                  'route' =>  ['purchases.update', $purchase->id],
                  'files' =>  true,
                  'method'  =>  'put'
                ])--}}
                    <!-- Default box -->
                    <div class="box">
                      <div class="box-header with-border">
                        <h6 class="box-title">Renew Purchase</h6>
                        @include('admin.errors')
                      </div>
                      <!--div class="box-body">
                        <div class="col-md-6"-->
                          <div class="form-group">
                            <label for="exampleInputEmail1"></label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$purchase->qty}}" name="qty">
                          </div>
                        <!--/div>
                        
                      </div-->
                        
                    </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button class="btn btn-warning pull-right">Edit</button>
                      </div>
                      <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                {{Form::close()}}
               @endif
                  </td>                  
                  <td>{{$purchase->first()->book->price * $purchase->qty}}
                  </td>
                  @if($purchase->first()->book->author->status_discont_id == 1)
                  @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
                  <td>{{$purchase->first()->book->discont_global}}</td>
                  <td>{{($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty}}</td>
                  @else
                  <td>{{$purchase->first()->book->author->discont_id}}</td>
                  <td>{{($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty}}</td>
                  @endif
                  @endif
                @else($purchase->magazin_id != null)
                <td>{{$purchase->id}}</td>
                   <td>{{$purchase->first()->magazin->name}}
                  </td>
                  <td>{{$purchase->first()->magazin->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td> 
                 @if(Auth::check())  
                  {{Form::open([
                  'route' =>  ['purchases.update', $purchase->id],
                  'files' =>  true,
                  'method'  =>  'put'
                ])}}
                    <!-- Default box -->
                    <div class="box">
                      <div class="box-header with-border">
                        <h6 class="box-title">Renew Purchase</h6>
                        @include('admin.errors')
                      </div>
                      <!--div class="box-body">
                        <div class="col-md-6"-->
                          <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$purchase->qty_m}}" name="qty_m">
                          </div>
                        <!--/div>
                        
                      </div-->
                        
                    </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button class="btn btn-warning pull-right">Edit</button>
                      </div>
                      <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                {{Form::close()}}
               @endif
                  </td>                  
                  <td>{{$purchase->first()->magazin->price * $purchase->qty_m}}
                  </td> 
                  @if($purchase->magazin->author->status_discont_id == 1)
                  @if($purchase->magazin->discont_global > $purchase->magazin->author->discont_id)
                  <td>{{$purchase->magazin->discont_global}}</td>
                  <td>{{($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m}}</td>
                  @else
                  <td>{{$purchase->magazin->author->discont_id}}</td>
                  <td>{{($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m}}</td>
                  @endif
                  @endif
                 @endif 
                </tr>               
                @endforeach
                </tfoot>                
              </table>
           
                </div><!--end leave comment-->
                @endif
 
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


    
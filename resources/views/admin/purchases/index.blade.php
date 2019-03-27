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
@foreach($purchases as $purchase)
        <div class="form-group">
                <a href="{{route('admin.purchases.indexDayBefore')}}" class="btn btn-success">Purchase per Day</a>
                @if($purchase->first()->book->author->status_discont_id == 1)
                  @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
                  <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty)->count() + (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m)}}</td>
                  @else
                  <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty)->count() + (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m)->count()}}</td>
                  @endif
                  @endif 
                @if($purchase->first()->book->author->status_discont_id == 1)
                  @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
                  <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty)->count()}}</td>
                  @else
                  <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty)->count()}}</td>
                  @endif
                  @endif 
                @if($purchase->first()->book->author->status_discont_id == 1)
                  @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
                  <td>{{ (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m)}}</td>
                  @else
                  <td>{{ (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m)->count()}}</td>
                  @endif
                  @endif 

                {{$purchase->qty->count() + $purchase->qty_m->count()}}
                {{$purchase->qty->count()}}
                {{$purchase->qty_m->count()}}
              </div>
              <div class="form-group">
                <a href="{{route('admin.purchases.indexWeekBefore')}}" class="btn btn-success">Purchase per Week</a>
              </div>
              <div class="form-group">
                <a href="{{route('admin.purchases.indexMonthBefore')}}" class="btn btn-success">Purchase per Month</a>
              </div>
              @endforeach
            <div class="box-header">
              <h3 class="box-title">Listing</h3>
              
                   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                
              </div>
              @if(Auth::check())
                    <div class="leave-comment"><!--leave comment-->
                        


    
            @foreach($purchases as $purchase)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Not Paid</th>
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
                <!--foreach-->
                <tr>
                  <td>
                  @if($purchase->status_paied == 0)
                    <a href="purchases/toggle/{{$purchase->id}}" class="fa fa-lock"></a> 
                  @else
                      <a href="purchases/toggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a> 
                  @endif
              </td>
                  <td> {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>
                      <!--a href="{{route('purchases.edit', $purchase->id)}}" class="fa fa-pencil"></a-->

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
                  <td>{{$purchase->qty}}</td>
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
                <td>{{($purchase->order_id)}}</td>
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->magazin->name}}
                  </td>
                  <td>{{$purchase->magazin->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td> 
                  <td>{{$purchase->qty_m}}</td>
                  <td>{{$purchase->magazin->price * $purchase->qty_m}}
                  </td> 
                  <!--magaz discont-->
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
                  <td>{{$purchase->book_or_mag}}</td>
                </tr>
                <!--endforeach-->
                </tfoot>
                </tbody>
              </table>
              @endforeach
                   
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
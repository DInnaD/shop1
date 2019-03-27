 @extends('homes.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  {{--dd($purchases->first()->magazin->name)--}}
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
              <h2 class="box-title">
                <a style="margin-left: 30px !important;" href="{{route('purchases.buy')}}">Pay</a></h2>
                <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('home.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> Back
            </a>
            </div>
            <div style="margin-left: 30px !important;">
               {{--Form::open(['route'=>['purchases.destroyAll', $purchases], 'method'=>'delete'])--}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove">Del All</i>
                      </button>

                       {{--Form::close()--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
              </div>
              @if(Auth::check())
                    <div class="leave-comment"><!--leave comment-->
             
               

                  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>Add</th>
                  <th>Del</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Date</th>
                  <th>Summa</th>
                  <th>Discont</th>
                  <th>Price-%</th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                  
                   @foreach($purchases as $purchase)
              <td>
                  @if($purchase->status_bought == 1)
                  
                    <button class="btn send-btn"><a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a></button>
                    </form> 
                  @else
                      <a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-lock"></a> 
                  @endif
              </td>
              <td>
                  {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>

                       {{Form::close()}}
                   </td>
                   @if($purchase->book_id == 1)
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->book->name}}
                  </td>
                  <td>{{$purchase->book->price}}
                  </td>
                  <td>{{$purchase->qty}}</td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td>{{$purchase->book->price * $purchase->qty}}
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
                  @else($purchase->magazin_id == null)
                  <td>{{$purchase->id}}</td>
                   <td>{{$purchase->magazin->name}}
                  </td>
                  <td>{{$purchase->magazin->price}}
                  </td>
                  <td>{{$purchase->qty_m}}</td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td>{{$purchase->magazin->price * $purchase->qty_m}}
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
              
              </tbody></tfoot></table>
                 
           
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


    
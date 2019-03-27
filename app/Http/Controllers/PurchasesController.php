<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Magazin;
use App\Book;
use App\Order;
use App\Purchase;

class PurchasesController extends Controller
{

    public function toggleBeforeToggle($id)
    {
        $purchase = Purchase::find($id);//where it got// order in toggle
        $purchase->toggleStatusBuy();

        
        return redirect()->back();
    }

    public function toggleBeforeToggle_m($id)
    {
        $purchase = Purchase::find($id);//where it got// order in toggle
        $purchase->toggleStatusBuy();

        
        return redirect()->back();
    }

    // public function toggleBookOrMagazin($id){

    //     $purchase = Purchase::find($id);
    //     $purchase->toggleBookOrMagazin();

    // }
    
    public function buy(){
        $user_id = \Auth::user()->id;
        $purchases = Purchase::where('user_id', $user_id)->where('status_bought', '!=', null)->get();//status_bought not workonly with 1 we can create new Order
       //if($purchase->status_bought == 1){    
            $order = new Order();
            // $order->qty = $order->purchase->qty->count();
            // $order->qty_m = $order->purchase->qty_m->count(); 
            // fill purchase data
            $order->save();

            
       //}
        foreach ($purchases as $purchase) {

            $purchase->order_id = $order->id;
        
            
      //notWORKKKKKKKKKKKKKKKKKKKKK
        }
        
        return redirect()->route('orders.index');
    }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexCart()
    {
        $user_id = \Auth::user()->id;

        $purchases = Purchase::where('order_id', '!=', 'null')->get();

                   
       // $purchases = Purchase::where('user_id', $user_id)->get();//->where('order_id', 'true')->get();//dd($purchases);
        //$orders = Order::all();
        return view('purchases.index', ['purchases'=>$purchases]);//->with('purchases', $purchases);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Purchase $purchase, Book $book, Magazin $magazin)
    {

         $user_id = \Auth::user()->id;
        //return view('homes.pay', [
          //'purchases' => Purchase::orderBy('created_at', 'desc')->paginate(10)
        //]);
         $purchases = Purchase::all();//query()->with(['book', 'magazin'])->get();//->toArray();
        return view('homes.pay', ['purchases'=>$purchases]);
   }
    // public function index(Order $order, Purchase $purchase)
    // {
    // //получить всех подписчиков из списка просто вызвав свойство обьекта, с которым они связаны
    //     // $purchases = $order->purchases; 
    //     // return view('homes.cart', compact('order'));
     
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($purchase->book_id != null){
                $this->validate($request, [
                    'qty'   =>  'required'
                ]);//not 0
        }
        else{
                $this->validate($request, [
                    'qty_m'   =>  'required'
                ]);//not 0
        }

        $purchase = new Purchase;
        $purchase->qty = $request->get('qty');
        $purchase->qty_m = $request->get('qty_m');
        $purchase->book_id = $request->get('book_id');
        $purchase->magazin_id = $request->get('magazin_id');
        //$purchase->order_id = $request->get('order_id');//make buy button
        $purchase->user_id = \Auth::user()->id;
        $purchase->save();

        
        return redirect()->route('purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);

       // return view('purchases.edit', compact(
       //     'purchase'
       // ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // { 
    //     $purchase = Purchase::find($id);
    //     $purchase->edit($request->get('qty'));
    //     $purchase->edit($request->get('qty_m'));

    //     return redirect()->route('cart');
        
    // }
        public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::find($id)->remove();
        return redirect()->back();
    }

    public function destroyAll()
    {
        foreach ($purchases as $purchase) {
            $purchase->remove();
        }
        return redirect()->back();
    }
}

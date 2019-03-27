<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\Orders_product;
use Illuminate\Http\Request;

class Orders_productsController extends Controller
{
    public function index()
    {
       
        $orders_products = Orders_product::all();
        return view('homes.buy', ['orders_products' => $orders_products]);
 
    }
    //homes.buy submitButton
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'qty'   =>  'required'
        // ]);


            $orders_product = new Orders_product;

            $orders_product->date = $request->get('date');
            $orders_product->status_paied = $request->get('status_paied');
            //$orders->getSum($request->get('sum'));
            $orders_product->user_id = Auth::user()->id;
            $orders_product->save();

             return redirect()->route('homes.buy');





            //$orders_product->sum_m = $request->get('sum_m');
            //$orders_product->sum = $request->get('sum');
           // $orders_product->date_m = $request->get('date_m');
            
            //$orders_product->book_id = $request->get('book_id');
            //$orders_product->magazin_id = $request->get('magazin_id');
            //$orders_product->order_id = $request->get('order_id');
            // $orders_product->book_id = Book::book()->id;
            // $orders_product->magazin_id = Magazin::magazin()->id;
            

            //    
    }

    //     /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param SubscriberRequest $subscriberRequest
    //  * @param Bunch $bunch
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function store(Bunch $bunch, Subscriber $subscriber, SubscriberRequest $subscriberRequest)
    // {
    //     //Auth::user()->
    //     $bunch->subscribers()->create($subscriberRequest->all());

    //     return redirect()->route('subscriber.index', compact('bunch', 'subscriber'));//->withBunch($bunch);//->with('me');
    // }


    
    
    // public function storeNext(Request $reques)
    // {

    //     $orders_product->toggleStatus($request->get('status_paied'));

    //     return redirect()->back()->with('status_paied', 'Add To Cart');
    // }
    
}

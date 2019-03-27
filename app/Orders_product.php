<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;


class Orders_product extends Model
{
	//use Selectable, SoftDeletes;//, Owned;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'book_id', 'magazin_id', 'date', 'qty', 'status_paied', 'book_or_mag', 'price',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    // public function order(){
    //     return $this->belongsTo(Order::class);
    // }
     public function orders()
    {//est one data for curr table
        return $this->hasMany(Order::class);
    }

    public function author()//is_adm
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function books()
    // {
    //     return $this->hasMany(Book::class);
    // }

    // public function magazins()
    // {
    //     return $this->hasMany(Magazin::class);
    // }

    // public function magazin()
    // {
    //     return $this->belongsTo(Magazin::class, 'magazin_id');
    // }

    // public function book()
    // {
    //     return $this->belongsTo(Book::class, 'book_id');
    // }
    


    public static function add($fields)
    {
    	$orders_product = new static;
    	$orders_product->fill($fields);
        $orders_product->book_id = Book::book()->id;
        $orders_product->magazin_id = Magazin::magazin()->id;
    	$orders_product->user_id = Auth::user()->id;// not use in hidden input - everyone can change with id=1 
    	$orders_product->save();

    	return $orders_product;
    }

    public function edit($fields)
    {
    	$this->fill($fields);
    	$this->save();
    }

    public function remove()
    {
    	//$this->removeImage();
    	$this->delete();
    }

   public function allow()
    {
    	$this->status_paied = 1;
    	$this->save();
    }

    public function disAllow()
    {
    	$this->status_paied = 0;
    	$this->save();
    }

    public function toggleStatus()
    {
    	if($this->status_paied == 0)
    	{
    		return $this->allow();//click oplatit pay!
    	}

    	return $this->disAllow();
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Item;
use App\Price;


class MonitorController extends Controller
{
    //metodo index
    public function index(Request $request)
    {
    	$search = $request->input('search');
    	if ($search) {
    		$query = '%'. $search . '%';
    		 $items = Item::where('name', 'like', $query)->orderBy('name')->paginate(10);
    	}else{
    		 $items = Item::orderBy('name')->paginate(10);
    	}

      
       $startdate = Carbon::now()->subDays(7);
       $enddate = Carbon::now();


       //esta parte es para la busqueda de detalles
       $itemId =  $request->input('item_id');
       if ($itemId)
       {
	       $prices =	Price::where('item_id', $itemId)
	    			->whereBetween('created_at', [$startdate, $enddate])
	    			->get();
       }else{
       	 $prices = [];
       }
        return view('monitor.index', compact('items', 'search', 'prices', 'startdate', 'enddate', 'itemId'));
    }
}

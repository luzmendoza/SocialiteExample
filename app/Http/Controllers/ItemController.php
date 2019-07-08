<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    //pantalla principal
    public function index(Request $request)
    {
    	$search = $request->input('search');
    	if ($search) {
    		$query = '%'. $search . '%';
    		 $items = Item::where('name', 'like', $query)->orderBy('name')->paginate(10);
    	}else{
    		 $items = Item::orderBy('name')->paginate(10);
    	}

       
        return view('items.index', compact('items', 'search'));
    }
    //crear un nuevo registro
    public function store(Request $request)
    {
    	Item::create($request->all());
        return back();//regresar a la pagina donde estemos ubicados
    }
    
    //eliminar un registro
    public function destroy(Item $item)
    {
        $item->delete();//eliminacion fisica
        return back();//regresar a la pagina donde estemos ubicados
    }
}

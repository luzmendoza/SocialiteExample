<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Price;//PARA LA ELIMINACION CONDICIONADA(fisica/logica)


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
        //validar para hacer una eliminacion logica o fisica
        if (Price::where('item_id',$item->id)->exists()) {
            $item->delete();//eliminacion logica
        }else{
             $item->forceDelete();//eliminacion fisica
        }
        return back();//regresar a la pagina donde estemos ubicados
    }

    //obtener un registro a editar
    public function edit(Item $item)
    {
        $items = Item::all();
        return view('items.edit', compact('item'));
    }

    //editar registro
    public function update(Request $request, Item $item)
    {
        $item->update($request->only('name'));
        return redirect('/items');//regresar 
    }
}

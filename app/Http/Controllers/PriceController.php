<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Price;
use App\Exports\PricesExport;
use Excel;

class PriceController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'location_id' => 'required',
            'item_id' => 'required'
        ];
        $messages = [
            'location_id.required' => 'Es obligatorio seleccionar una ubicación',
            'item_id.required' => 'Es obligatorio seleccionar un item'
        ];
        $this->validate($request, $rules, $messages);
    	//hacer un arreglo para guardar los datos
    	$data = $request->all();
    	$data['user_id'] =  auth()->user()->id;//usuario con sesion activa
    	Price::create($data);
    	return back();
    }

     public function destroy(Price $price)
    {
    	//eliminar
    	$price->delete();
    	return back();
    }

     public function download(Item $item)
    {
        $filename = "detalles del item $item->name.xlsx";
        $export = new PricesExport($item->id);
        //descarga de archivo excel
        return Excel::download($export, $filename );
    }
    
}

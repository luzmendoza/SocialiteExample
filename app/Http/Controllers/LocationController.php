<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    //pantalla principal
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }
    //crear un nuevo registro
    public function store(Request $request)
    {
    	Location::create($request->all());
        return back();//regresar a la pagina donde estemos ubicados
    }
    
    //eliminar un registro
    public function destroy(Location $location)
    {
        $location->delete();//eliminacion fisica
        return back();//regresar a la pagina donde estemos ubicados
    }
}

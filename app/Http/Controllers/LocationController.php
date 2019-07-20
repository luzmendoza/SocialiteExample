<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Price;//PARA LA ELIMINACION CONDICIONADA(fisica/logica)

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
        //validar para hacer una eliminacion logica o fisica
        if (Price::where('location_id',$location->id)->exists()) {
            $location->delete();//eliminacion logica
        }else{
             $location->forceDelete();//eliminacion fisica
        }
       
        return back();//regresar a la pagina donde estemos ubicados
    }

     //obtener un registro a editar
    public function edit(Location $location)
    {
        $locations = Location::all();
        return view('locations.edit', compact('location'));
    }

    //editar registro
    public function update(Request $request, Location $location)
    {
        $location->update($request->only('name'));
        return redirect('/locations');//regresar 
    }
}

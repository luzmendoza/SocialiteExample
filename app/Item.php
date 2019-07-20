<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	//estableciendo el uso de borrado logico
	use SoftDeletes;
    //campos que seran llenado en la base de datos
    protected $fillable = ['name'];

    //obtener el valor mas bajo
    public function lowestValue($startdate, $enddate)
    {
    	return Price::where('item_id', $this->id)
    			->whereBetween('created_at', [$startdate, $enddate])
    			->min('value');
    }
}

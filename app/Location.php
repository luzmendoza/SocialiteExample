<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    //estableciendo el uso de borrado logico
	use SoftDeletes;
    //campos que seran llenado en la base de datos
    protected $fillable = ['name'];
}

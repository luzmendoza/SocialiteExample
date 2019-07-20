<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class price extends Model
{
    //
    protected $fillable = ['location_id', 'item_id', 'user_id', 'value'];

    //modelos asociados... relaciones entre modelos

    //price->user->name
    //N - 1
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //price->location->name
    //N - 1
    //->withTrashed(); se utiliza para mostrar datos que han sido eliminado de forma logica
    public function location()
    {
    	return $this->belongsTo(Location::class)->withTrashed();
    }
    
    //price->item->name
    //N - 1
    public function item()
    {
    	return $this->belongsTo(Item::class)->withTrashed();
    }
}

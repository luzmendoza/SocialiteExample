<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Price;
use Carbon\Carbon;

class PricesExport implements FromCollection, WithHeadings, WithMapping
{
	private $itemID;
	public function __construct($itemId)
	{
		$this->itemID = $itemId;
	}
	public function headings(): array
    {
        return [
           //['First row', 'First row'],
           //['Second row', 'Second row'],
        	'Ubicación',
        	'Nombre',
        	'Usuario',
        	'Valor',
        	'Fecha'
        ];
    }

	public function collection()
	{
		//calculo de fechas cuando no es por seleccion y esta delimitada a cierta cantidad
		$startdate = Carbon::now()->subDays(7);
       	$enddate = Carbon::now();

		return Price::with('location','item','user')
			->whereBetween('created_at', [$startdate, $enddate])
			->where('item_id',$this->itemID)
			->get([
					'location_id',
					'item_id',
					'user_id',
					'value',
					'created_at'
				]);
	}	

	//mapear datos para cambiar el valor a devolver
	public function map($price): array
	{
		return [
			$price->location->name,
			$price->item->name,
			$price->user->name,
			$price->value,
			$price->created_at
		];
	}

}

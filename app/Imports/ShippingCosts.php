<?php
namespace App\Imports;
use App\ShippingCost;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class ShippingCosts implements ToCollection{
    public function collection(Collection $collection){
          foreach ($collection as $item) {
            ShippingCost::create([
              'shipping_method' => $item[0],
              'country_name' => $item[4],
              'weight_from' => $item[1],
              'weight_to' => $item[2],
              'cost' => $item[3]
            ]);
          }
    }
}

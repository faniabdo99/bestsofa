<?php
namespace App\Imports;
use App\Product;
use App\Product_Local;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection{
  public function collection(Collection $rows){
    // dd("Working on it ...");
    foreach ($rows as $key => $row) {
      //Create the Product
      Product::create([
          'id' => $key+1,
         'title' => $row[0],
         'slug' => $row[19],
         'description' => $row[3],
         'body' => $row[3],
         'image' => 'product.jpeg',
         'category_id' => 1,
         'price' => $row[10],
         'show_inventory' => 0,
         'inventory' => $row[14],
         'fake_inventory' => $row[14],
         'min_order' => 0,
         'status' => $row[8],
         'weight' => $row[15],
         'weight' => $row[15],
         'tax_rate' => $row[12],
         'is_promoted' => ($row[18] == 'Yes') ? 1 : 0,
         'allow_reviews' => 1,
         'allow_reservations' => 0,
         'user_id' => 1,
         'season' => 'summer',
         'gender' => 'men'
     ]);
     //Create a Translation File
     Product_Local::create([
       'product_id' => $key+1,
       'lang_code' => 'fr',
       'title_value' => $row[4],
       'slug_value' => $row[19],
       'description_value' => $row[5],
       'body_value' => $row[5]
     ],[
       'product_id' => $key+1,
       'lang_code' => 'nl',
       'title_value' => $row[5],
       'slug_value' => $row[19],
       'description_value' => $row[6],
       'body_value' => $row[6]
     ]
      );
    }

    }
}

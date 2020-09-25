<?php
namespace App\Imports;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
class UsersImport implements ToModel{
    public function model(array $row){
        return new User([
          'first_name' => $row[0],
          'last_name' => $row[1],
          'company_name' => $row[2],
          'email' => $row[9],
          'phone_number' => $row[10],
          'country' => $row[8],
          'city' => $row[7],
          'street_address' => $row[4],
          'zip_code' => $row[6],
          'vat_number' => $row[3],
          'password' => 'PlaceholderPass',
          'code' => rand(0,99999999),
          'confirmed' => 1,
          'role' => 1,
          'auth_provider' => 'Backup',

        ]);
    }
}

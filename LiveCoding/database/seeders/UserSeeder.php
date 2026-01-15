<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(database_path('seeders/csv/users.csv'), 'r');
        fgetcsv($file); // Sauter l'entête
        
        while (($data = fgetcsv($file)) !== FALSE) {
            User::updateOrCreate(
                ['id' => $data[0]],
                [
                    'name'     => $data[1],
                    'email'    => $data[2],
                    'password' => Hash::make($data[3]),
                ]
            );
        }
        fclose($file);
    }
}
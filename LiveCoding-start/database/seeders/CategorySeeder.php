<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(database_path('seeders/csv/categories.csv'), 'r');
        fgetcsv($file); // Sauter l'entête
        
        while (($data = fgetcsv($file)) !== FALSE) {
            Category::updateOrCreate(
                ['id' => $data[0]], // On garde l'ID du CSV pour la cohérence
                ['name' => trim($data[1])]
            );
        }
        fclose($file);
    }
}
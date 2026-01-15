<?php
namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Category;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(database_path('seeders/csv/goals.csv'), 'r');
        fgetcsv($file);

while (($data = fgetcsv($file)) !== FALSE) {
    // 1. Créer le Goal (sans progress)
    $goal = Goal::create([
        'user_id'     => $data[0],
        'title'       => $data[1],
        'description' => $data[2],
        'status'      => $data[3],
        'image'       => $data[4],
    ]);

    // 2. Gérer les Multi-Catégories
    if (!empty($data[5])) {
        $categoryNames = explode(',', $data[5]);
        $categoryIds = [];

        foreach ($categoryNames as $name) {
            $category = Category::where('name', trim($name))->first();
            if ($category) {
                $categoryIds[] = $category->id;
            }
        }
        $goal->categories()->sync($categoryIds);
    }
}
        fclose($file);
    }
}
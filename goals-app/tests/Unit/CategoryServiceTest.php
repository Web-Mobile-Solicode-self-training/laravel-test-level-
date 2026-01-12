<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; // Import de l'attribut
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private CategoryService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CategoryService();
    }

    #[Test] // Remplace /** @test */
    public function it_can_get_all_categories_sorted_by_name()
    {
        Category::create(['name' => 'Zen']);
        Category::create(['name' => 'Alpha']);

        $categories = $this->service->all();

        $this->assertCount(2, $categories);
        $this->assertEquals('Alpha', $categories->first()->name);
    }
}

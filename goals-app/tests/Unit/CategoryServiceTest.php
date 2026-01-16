<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private CategoryService $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the database to have categories available
        $this->seed();
        $this->categoryService = app(CategoryService::class);
    }

    #[Test]
    public function it_gets_all_categories_ordered_by_name(): void
    {
        // Act
        $categories = $this->categoryService->all();

        // Assert
        // We know from GoalServiceTest that there are at least "Développement Web", "Sport", etc.
        // Let's assert we have some categories
        $this->assertNotEmpty($categories);

        // Verify the order
        $sortedNames = $categories->pluck('name');
        $expectedSortedNames = $categories->pluck('name')->sort()->values();

        $this->assertEquals($expectedSortedNames, $sortedNames);
    }
}

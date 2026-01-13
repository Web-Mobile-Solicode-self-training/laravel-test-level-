<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Goal;
use App\Services\GoalService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoalServiceTest extends TestCase
{
    use RefreshDatabase;

    private GoalService $goalService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->goalService = app(GoalService::class);
    }

    #[Test]
    public function it_gets_all_goals(): void
    {
        $results = $this->goalService->list();
        $this->assertCount(3, $results);
    }

    #[Test]
    public function it_filters_by_title_only(): void
    {
        // Act: Search for 'Portfolio'
        $results = $this->goalService->list(search: 'Portfolio');

        // Assert
        $this->assertCount(1, $results);
        $this->assertEquals('Créer un Portfolio', $results->first()->title);
    }

    #[Test]
    public function it_filters_by_category_only(): void
    {
        // Arrange: Find 'Développement Web' (Linked to Laravel and Portfolio in your data)
        $category = Category::where('name', 'Développement Web')->first();

        // Act
        $results = $this->goalService->list(categoryId: $category->id);

        // Assert
        $this->assertCount(2, $results);
        $this->assertTrue($results->contains('title', 'Apprendre Laravel 12'));
    }

    #[Test]
    public function it_updates_a_goal(): void
    {
        $goal = Goal::first();
        
        $this->goalService->save(['title' => 'New Title'], $goal);

        $this->assertDatabaseHas('goals', ['id' => $goal->id, 'title' => 'New Title']);
    }

    #[Test]
    public function it_deletes_a_goal(): void
    {
        $goal = Goal::first();
        $id = $goal->id;

        $this->goalService->delete($goal);

        $this->assertDatabaseMissing('goals', ['id' => $id]);
    }
}
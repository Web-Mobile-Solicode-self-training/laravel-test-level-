<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Goal;
use App\Models\Category;
use App\Services\GoalService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoalServiceTest extends TestCase
{
    use RefreshDatabase; // This will migrate:fresh your goals_app_test DB

    private GoalService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new GoalService();
    }

    #[Test]
    public function it_can_persist_a_new_goal_with_categories()
    {
        // 1. Create a user (required by your migration)
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. Create a category
        $category = Category::create(['name' => 'Tech']);

        $data = [
            'title' => 'Finish Laravel Project',
            'description' => 'Adding i18n support',
            'status' => 'in_progress',
            'category_ids' => [$category->id]
        ];

        // 3. Act
        $goal = $this->service->save($data);

        // 4. Assert
        $this->assertDatabaseHas('goals', ['title' => 'Finish Laravel Project']);
        $this->assertDatabaseHas('category_goal', [
            'goal_id' => $goal->id,
            'category_id' => $category->id
        ]);
    }
}
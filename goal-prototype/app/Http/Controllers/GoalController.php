<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Services\{GoalService, CategoryService};
use Illuminate\Http\{Request, JsonResponse};

class GoalController extends Controller
{
    // PHP 8+ Constructor Property Promotion
    public function __construct(
        protected GoalService $goalService,
        protected CategoryService $categoryService
    ) {}

    public function index(Request $request)
    {
        $goals = $this->goalService->list(
            categoryId: $request->category_id,
            status: $request->status,
            search: $request->search
        );

        return $request->ajax() 
            ? view('admin.partials.table', compact('goals'))->render()
            : view('admin.index', [
                'goals' => $goals,
                'categories' => $this->categoryService->all()
            ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'status'         => 'required|in:todo,in_progress,completed',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_ids'   => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $this->goalService->save($data);

        return response()->json(['success' => true, 'message' => 'Objectif ajouté'], 201);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Services\GoalService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $goalService;
    protected $categoryService;

    public function __construct(GoalService $goalService, CategoryService $categoryService)
    {
        $this->goalService = $goalService;
        $this->categoryService = $categoryService;
    }

    // Dashboard & List View
    public function index(Request $request)
    {
        $goals = $this->goalService->list(
            $request->category_id,
            $request->status,
            $request->search
        );
        $categories = $this->categoryService->all();

        if ($request->ajax()) {
            return view('admin.goals.partials.table', compact('goals'))->render();
        }

        return view('admin.index', compact('goals', 'categories'));
    }

    // Create & Update (Unified via GoalService->save)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in_progress,completed',
            'progress' => 'required|integer|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_ids' => 'nullable|array',
        ]);

        $goal = null;
        if ($request->has('goal_id')) {
            $goal = $this->goalService->find($request->goal_id);
        }

        $this->goalService->save($data, $goal);

        return response()->json(['success' => true, 'message' => 'Opération réussie!']);
    }

    // Get data for Edit Modal (AJAX)
    public function edit(int $id)
    {
        $goal = $this->goalService->find($id);
        return response()->json([
            'goal' => $goal,
            'category_ids' => $goal->categories->pluck('id')
        ]);
    }

    // Delete
    public function destroy(int $id)
    {
        $goal = $this->goalService->find($id);
        $this->goalService->delete($goal);
        
        return response()->json(['success' => true]);
    }
}
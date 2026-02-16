<?php

namespace App\Http\Controllers;

use App\Services\GoalService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    protected $goalService;
    protected $categoryService;

    public function __construct(GoalService $goalService, CategoryService $categoryService)
    {
        $this->goalService = $goalService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $user = auth()->user();

        // Both admins and authors can now see all goals
        $goalsQuery = $this->goalService->list();

        return view('admin.index', [
            'goals' => $goalsQuery,
            'categories' => $this->categoryService->all()
        ]);
    }

    public function save(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'nullable|integer|exists:goals,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'image' => 'nullable|image|max:2048',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        if ($request->id) {
            Gate::authorize('edit-goal');
            $goal = $this->goalService->find($request->id);
        } else {
            Gate::authorize('create-goal');
            $goal = null;
        }

        $this->goalService->save($request->all(), $goal);

        return response()->json(['success' => true]);
    }

    public function edit(int $id): JsonResponse
    {
        return response()->json($this->goalService->find($id));
    }

    public function destroy(int $id): JsonResponse
    {
        Gate::authorize('delete-goal');

        $goal = $this->goalService->find($id);
        $this->goalService->delete($goal);
        return response()->json(['success' => true]);
    }
}
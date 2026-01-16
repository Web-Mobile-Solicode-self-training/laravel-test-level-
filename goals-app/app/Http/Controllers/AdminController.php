<?php

namespace App\Http\Controllers;

use App\Services\GoalService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
        return view('admin.index', [
            'goals' => $this->goalService->list(),
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

        $goal = $request->id ? $this->goalService->find($request->id) : null;
        $this->goalService->save($request->all(), $goal);

        return response()->json(['success' => true]);
    }

    public function edit(int $id): JsonResponse
    {
        return response()->json($this->goalService->find($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $goal = $this->goalService->find($id);
        $this->goalService->delete($goal);
        return response()->json(['success' => true]);
    }
}
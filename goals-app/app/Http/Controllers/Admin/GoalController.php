<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Services\GoalService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function __construct(
        protected GoalService $goalService,
        protected CategoryService $categoryService
    ) {}

    // DISPLAY & FILTER
    public function index(Request $request)
    {
        $goals = $this->goalService->list(
            $request->integer('category_id') ?: null,
            $request->string('status') ?: null,
            $request->string('search') ?: null
        );
        
        $categories = $this->categoryService->all();
        return view('admin.goals.index', compact('goals', 'categories'));
    }

    // CREATE
    public function create()
    {
        $categories = $this->categoryService->all();
        return view('admin.goals.create', compact('categories'));
    }

    // STORE (CREATE NEW)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'category_ids' => 'required|array',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $this->goalService->save($data);
        return redirect()->route('admin.goals.index')->with('success', 'Goal created!');
    }

    // EDIT
    public function edit(Goal $goal)
    {
        $categories = $this->categoryService->all();
        return view('admin.goals.edit', compact('goal', 'categories'));
    }

    // UPDATE
    public function update(Request $request, Goal $goal)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'category_ids' => 'required|array',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $this->goalService->save($data, $goal);
        return redirect()->route('admin.goals.index')->with('success', 'Goal updated!');
    }

    // DELETE
    public function destroy(Goal $goal)
    {
        $this->goalService->delete($goal);
        return back()->with('success', 'Goal deleted!');
    }
}
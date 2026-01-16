<?php

namespace App\Http\Controllers;

use App\Services\GoalService;
use App\Services\CategoryService;

class GoalController extends Controller
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
        // Fetch all goals and categories using your services
        $goals = $this->goalService->list();
        $categories = $this->categoryService->all();

        return view('public.index', compact('goals', 'categories'));
    }

    public function show($id)
    {
        $goal = $this->goalService->find($id);
        return view('public.show', compact('goal'));
    }
}
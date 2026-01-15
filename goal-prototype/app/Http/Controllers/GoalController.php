<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        $goals = Goal::with('categories')
            ->when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })->latest()->get();

        if ($request->ajax()) {
            return view('admin.partials.table', compact('goals'))->render();
        }

        return view('admin.index', compact('goals', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'image' => 'nullable|image|max:2048',
            'category_ids' => 'nullable|array'
        ]);

        return DB::transaction(function () use ($request, $validated) {
            $goal = new Goal($validated);
            $goal->user_id = auth()->id() ?? 1; // Default for prototype

            if ($request->hasFile('image')) {
                $goal->image = $request->file('image')->store('goals', 'public');
            }

            $goal->save();

            if ($request->has('category_ids')) {
                $goal->categories()->sync($request->category_ids);
            }

            return response()->json(['success' => true]);
        });
    }
}
<?php

namespace App\Services;

use App\Models\Goal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GoalService
{
    public function list(?int $categoryId = null, ?string $status = null, ?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Goal::with('categories')
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            })
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage);
    }

    public function find(int $id): Goal
    {
        return Goal::with('categories')->findOrFail($id);
    }

    // Unified "Save" logic. If Goal is provided, it updates; otherwise, creates.
    public function save(array $data, ?Goal $goal = null): Goal
    {
        $goal = $goal ?? new Goal();

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image'], $goal->image);
        }

        $goal->fill($data);

        if (!$goal->exists) {
            $goal->user_id = auth()->id() ?? 1;
        }

        $goal->save();

        if (isset($data['category_ids'])) {
            $goal->categories()->sync($data['category_ids']);
        }

        return $goal->load('categories');
    }

    // Use the Model instead of ID for better readability
    public function delete(Goal $goal): bool
    {
        if ($goal->image) {
            Storage::disk('public')->delete($goal->image);
        }
        return $goal->delete();
    }

    private function uploadImage(UploadedFile $file, ?string $oldPath): string
    {
        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }
        return $file->store('goals', 'public');
    }
}
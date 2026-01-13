@extends('layouts.public')

@section('content')
    <div class="max-w-2xl px-4 py-8 mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight sm:text-3xl">Modifier l'objectif</h1>
            <p class="text-slate-500 mt-1">Mettez à jour les informations de l'objectif.</p>
        </div>

        <form action="{{ route('admin.goals.update', $goal) }}" method="POST" enctype="multipart/form-data"
            class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title', $goal->title) }}" required
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('description', $goal->description) }}</textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Statut</label>
                <select name="status" id="status" required
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @foreach(['todo', 'in_progress', 'completed'] as $status)
                        <option value="{{ $status }}" {{ $goal->status === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Categories -->
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Catégories</span>
                <div class="space-y-2">
                    @php $selectedCats = $goal->categories->pluck('id')->toArray(); @endphp
                    @foreach($categories as $category)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCats) ? 'checked' : '' }}
                                class="rounded border-slate-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-slate-600">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('category_ids') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-slate-700 mb-1">Image</label>
                @if($goal->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $goal->image) }}" class="w-16 h-16 rounded-lg object-cover">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded-full file:border-0
                  file:text-sm file:font-semibold
                  file:bg-blue-50 file:text-blue-700
                  hover:file:bg-blue-100
                " />
                <span class="text-xs text-slate-500">Laisser vide pour conserver l'image actuelle.</span>
                @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end gap-x-3 pt-4">
                <a href="{{ route('admin.goals.index') }}"
                    class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-medium bg-slate-100 text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all text-sm">
                    Annuler
                </a>
                <button type="submit"
                    class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
@endsection
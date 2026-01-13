@extends('layouts.public')

@section('content')
    <div class="max-w-2xl px-4 py-8 mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight sm:text-3xl">Créer un objectif</h1>
            <p class="text-slate-500 mt-1">Ajoutez un nouvel objectif à votre liste.</p>
        </div>

        <form action="{{ route('admin.goals.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Titre</label>
                <input type="text" name="title" id="title" required
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Statut</label>
                <select name="status" id="status" required
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="todo">À faire</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminé</option>
                </select>
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Categories -->
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Catégories</span>
                <div class="space-y-2">
                    @foreach($categories as $category)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
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
                <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded-full file:border-0
                  file:text-sm file:font-semibold
                  file:bg-blue-50 file:text-blue-700
                  hover:file:bg-blue-100
                " />
                @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end gap-x-3 pt-4">
                <a href="{{ route('admin.goals.index') }}"
                    class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-medium bg-slate-100 text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all text-sm">
                    Annuler
                </a>
                <button type="submit"
                    class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">
                    Créer l'objectif
                </button>
            </div>
        </form>
    </div>
@endsection
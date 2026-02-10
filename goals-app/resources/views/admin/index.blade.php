@extends('layouts.public')

@section('content')
    <div x-data="goalTable({ 
            goals: {{ $goals->getCollection()->toJson() }}, 
            categories: {{ $categories->toJson() }} 
        })" class="max-w-[85rem] px-4 py-8 mx-auto">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-y-4 mb-10">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight sm:text-3xl">Gestion des Objectifs</h1>
                <p class="text-slate-500 mt-1">Pilotez vos indicateurs de performance et vos étapes clés.</p>
            </div>
            <button @click="$dispatch('open-goal-modal')"
                class="inline-flex items-center justify-center gap-x-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition-all shadow-lg shadow-blue-100 font-semibold text-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Créer un objectif
            </button>
        </div>

        <!-- Filters -->
        <div class="bg-white border border-slate-200 rounded-2xl p-2 mb-6 shadow-sm flex flex-col md:flex-row gap-2">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="search" class="text-slate-400 w-4 h-4"></i>
                </div>
                <input type="text" x-model="search" placeholder="Filtrer par titre..."
                    class="pl-11 w-full border-none focus:ring-0 rounded-xl py-3 text-sm text-slate-700"
                    style="outline: none;">
            </div>
            <div class="h-10 w-px bg-slate-200 hidden md:block self-center"></div>
            <div class="md:w-72">
                <select x-model="selectedCategory"
                    class="w-full border-none focus:ring-0 rounded-xl py-3 text-sm text-slate-700 outline-none">
                    <option value="">Toutes les catégories</option>
                    <template x-for="cat in categories" :key="cat.id">
                        <option :value="cat.name" x-text="cat.name"></option>
                    </template>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider w-20">
                                Image</th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Titre</th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Catégories</th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Description</th>
                            <th class="px-6 py-4 text-right text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Outils</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <template x-for="goal in filteredGoals" :key="goal.id">
                            <tr class="goal-row hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="relative flex-shrink-0">
                                        <img :src="goal.image ? '/storage/' + goal.image : 'https://placehold.co/100x100?text=Goal'"
                                            class="w-12 h-12 rounded-xl object-cover ring-1 ring-slate-200 shadow-sm">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800 text-sm group-hover:text-blue-600 transition-colors"
                                        x-text="goal.title"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        <template x-for="c in goal.categories" :key="c.id">
                                            <span
                                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-white border border-slate-200 text-slate-500 shadow-sm"
                                                x-text="c.name"></span>
                                        </template>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-500 line-clamp-1 max-w-xs" x-text="goal.description"></p>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <button @click="editGoal(goal)"
                                            class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button @click="deleteGoal(goal.id)"
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredGoals.length === 0">
                            <td colspan="5" class="px-6 py-20 text-center">
                                <i data-lucide="inbox" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                                <p class="text-slate-500 text-sm">Aucun objectif trouvé.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 border-t border-slate-100 pt-6">
            {{ $goals->links('vendor.pagination.preline') }}
        </div>
    </div>

    @include('admin.modals.goal-modal')
@endsection
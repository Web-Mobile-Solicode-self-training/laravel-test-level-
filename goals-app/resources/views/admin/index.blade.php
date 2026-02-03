@extends('layouts.public')

@section('content')
    <div class="max-w-[85rem] px-4 py-8 mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-y-4 mb-10">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight sm:text-3xl">Gestion des Objectifs</h1>
                <p class="text-slate-500 mt-1">Pilotez vos indicateurs de performance et vos étapes clés.</p>
            </div>
            <button onclick="openModal()"
                class="inline-flex items-center justify-center gap-x-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition-all shadow-lg shadow-blue-100 font-semibold text-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Créer un objectif
            </button>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-2 mb-6 shadow-sm flex flex-col md:flex-row gap-2">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="search" class="text-slate-400 w-4 h-4"></i>
                </div>
                <input type="text" id="filter-search" onkeyup="filterTable()" placeholder="Filtrer par titre..."
                    class="pl-11 w-full border-none focus:ring-0 rounded-xl py-3 text-sm text-slate-700"
                    style="outline: none;">
            </div>
            <div class="h-10 w-px bg-slate-200 hidden md:block self-center"></div>
            <div class="md:w-72">
                <select id="filter-category" onchange="filterTable()" data-hs-select='{
                                    "placeholder": "Toutes les catégories",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-slate-200 rounded-xl text-sm text-start focus:ring-2 focus:ring-blue-500 transition-all outline-none",
                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-slate-200 rounded-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-100 [&::-webkit-scrollbar-thumb]:bg-slate-300",
                                    "optionClasses": "py-2 px-4 w-full text-sm text-slate-800 cursor-pointer hover:bg-slate-100 rounded-lg focus:outline-none focus:bg-slate-100",
                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><i data-lucide=\"check\" class=\"w-4 h-4 text-blue-600\"></i></span></div>"
                                }' class="hidden">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

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
                    <tbody id="goal-table-body" class="divide-y divide-slate-200">
                        @forelse($goals as $goal)
                            <tr class="goal-row hover:bg-slate-50/80 transition-colors group" id="row-{{ $goal->id }}"
                                data-title="{{ strtolower($goal->title) }}"
                                data-category="{{ $goal->categories->pluck('name')->join(',') }}">
                                <td class="px-6 py-4">
                                    <div class="relative flex-shrink-0">
                                        <img src="{{ $goal->image ? asset('storage/' . $goal->image) : 'https://placehold.co/100x100?text=Goal' }}"
                                            class="w-12 h-12 rounded-xl object-cover ring-1 ring-slate-200 shadow-sm">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="font-semibold text-slate-800 text-sm group-hover:text-blue-600 transition-colors">
                                        {{ $goal->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($goal->categories as $c)
                                            <span
                                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-white border border-slate-200 text-slate-500 shadow-sm">
                                                {{ $c->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-500 line-clamp-1 max-w-xs">
                                        {{ $goal->description }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <button onclick="editGoal({{ $goal->id }})"
                                            class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button onclick="deleteGoal({{ $goal->id }})"
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <i data-lucide="inbox" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                                    <p class="text-slate-500 text-sm">Aucun objectif trouvé.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 border-t border-slate-100 pt-6">
            {{ $goals->links('vendor.pagination.preline') }}
        </div>
    </div>

    @include('admin.modals.goal-modal')

    <script>
        window.AdminConfig = {
            saveRoute: "{{ route('admin.save') }}"
        };
    </script>
@endsection
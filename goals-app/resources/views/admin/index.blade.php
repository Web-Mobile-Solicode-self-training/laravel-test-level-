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
                <select id="filter-category" onchange="filterTable()"
                    class="w-full border-none focus:ring-0 py-3 text-sm text-slate-600 cursor-pointer"
                    style="outline: none;">
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
                            <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Objectif</th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Statut</th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Catégories</th>
                            <th class="px-6 py-4 text-right text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody id="goal-table-body" class="divide-y divide-slate-200">
                        @forelse($goals as $goal)
                            <tr class="goal-row hover:bg-slate-50/80 transition-colors group" id="row-{{ $goal->id }}"
                                data-title="{{ strtolower($goal->title) }}"
                                data-category="{{ $goal->categories->pluck('name')->join(',') }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="relative flex-shrink-0">
                                            <img src="{{ $goal->image ? asset('storage/' . $goal->image) : 'https://placehold.co/100x100?text=Goal' }}"
                                                class="w-12 h-12 rounded-xl object-cover ring-1 ring-slate-200 shadow-sm">
                                        </div>
                                        <div
                                            class="font-semibold text-slate-800 text-sm group-hover:text-blue-600 transition-colors">
                                            {{ $goal->title }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusStyles = [
                                            'todo' => 'bg-slate-100 text-slate-700 border-slate-200',
                                            'in_progress' => 'bg-blue-50 text-blue-700 border-blue-100',
                                            'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        ];
                                        $style = $statusStyles[$goal->status] ?? $statusStyles['todo'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $style }}">
                                        {{ str_replace('_', ' ', ucfirst($goal->status)) }}
                                    </span>
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
                                <td colspan="4" class="px-6 py-20 text-center">
                                    <i data-lucide="inbox" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                                    <p class="text-slate-500 text-sm">Aucun objectif trouvé.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.modals.goal-modal')

    <script>
        window.AdminConfig = {
            saveRoute: "{{ route('admin.save') }}"
        };
    </script>
    @vite(['resources/js/admin.js'])
@endsection
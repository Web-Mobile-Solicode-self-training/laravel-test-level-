@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">
    <div class="flex justify-between items-center bg-white p-4 rounded-xl border shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Gestion des Objectifs</h1>
            <p class="text-sm text-slate-500">Créez, modifiez et suivez vos progrès.</p>
        </div>
        <button onclick="openAddModal()" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-md">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Nouvel Objectif
        </button>
    </div>

    <div class="bg-white p-4 rounded-xl border shadow-sm">
        <div class="relative max-w-md">
            <input type="text" id="admin-search" class="py-2.5 ps-11 block w-full border-gray-200 rounded-lg text-sm border focus:ring-blue-500" placeholder="Rechercher par titre...">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
            </div>
        </div>
    </div>

    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-start text-xs font-bold text-slate-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-start text-xs font-bold text-slate-500 uppercase">Objectif</th>
                    <th class="px-6 py-3 text-start text-xs font-bold text-slate-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-start text-xs font-bold text-slate-500 uppercase">Progrès</th>
                    <th class="px-6 py-3 text-end text-xs font-bold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody id="admin-table-body" class="divide-y divide-gray-200">
                @include('admin.goals.partials.table', ['goals' => $goals])
            </tbody>
        </table>
    </div>
</div>

@include('admin.goals.partials.modal-goal')

<script>
    // AJAX Live Search
    document.getElementById('admin-search').addEventListener('input', function(e) {
        fetch(`{{ route('admin.goals.index') }}?search=${e.target.value}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('admin-table-body').innerHTML = html;
            lucide.createIcons();
        });
    });

    // Delete Logic
    function deleteGoal(id) {
        if(confirm('Voulez-vous vraiment supprimer cet objectif ?')) {
            fetch(`/admin/goals/delete/${id}`, {
                method: 'DELETE',
                headers: { 
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(() => location.reload());
        }
    }
</script>
@endsection
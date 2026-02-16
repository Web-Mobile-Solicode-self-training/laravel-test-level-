<div class="flex flex-col md:flex-row md:items-center justify-between gap-y-4 mb-10">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight sm:text-3xl">Gestion des Objectifs</h1>
        <p class="text-slate-500 mt-1">Pilotez vos indicateurs de performance et vos étapes clés.</p>
    </div>
    @can('create-goal')
        <button @click="$dispatch('open-goal-modal')"
            class="inline-flex items-center justify-center gap-x-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition-all shadow-lg shadow-blue-100 font-semibold text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i> Créer un objectif
        </button>
    @endcan
</div>
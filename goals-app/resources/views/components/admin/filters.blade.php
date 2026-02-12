<div class="bg-white border border-slate-200 rounded-2xl p-2 mb-6 shadow-sm flex flex-col md:flex-row gap-2">
    <div class="relative flex-grow">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i data-lucide="search" class="text-slate-400 w-4 h-4"></i>
        </div>
        <input type="text" x-model="search" placeholder="Filtrer par titre..."
            class="pl-11 w-full border-none focus:ring-0 rounded-xl py-3 text-sm text-slate-700" style="outline: none;">
    </div>
    <div class="h-10 w-px bg-slate-200 hidden md:block self-center"></div>
    <div class="md:w-72">
        <x-ui.select x-model="selectedCategory" placeholder="Toutes les catégories">
            <template x-for="cat in categories" :key="cat.id">
                <option :value="cat.name" x-text="cat.name"></option>
            </template>
        </x-ui.select>
    </div>
</div>
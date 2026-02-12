<div x-show="isOpen" @open-goal-modal.window="handleOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-[60] overflow-y-auto bg-slate-900/40 backdrop-blur-sm p-4"
    @keydown.escape.window="closeModal()" style="display: none;">
    <div class="flex items-center justify-center min-h-screen">
        <div @click.away="closeModal()"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all border border-slate-200">

            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-xl font-bold text-slate-900"
                        x-text="isEditing ? 'Modifier l\'objectif' : 'Nouveau Goal'"></h3>
                    <p class="text-xs text-slate-500 mt-0.5">Remplissez les informations ci-dessous.</p>
                </div>
                <button @click="closeModal()"
                    class="p-2 rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form @submit.prevent="handleSubmit" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="id" :value="currentGoal.id">

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Titre de
                            l'objectif</label>
                        <input type="text" name="title" x-model="currentGoal.title"
                            placeholder="Ex: Maîtriser l'architecture Laravel"
                            class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400"
                            required>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Description</label>
                        <textarea name="description" x-model="currentGoal.description" rows="3"
                            placeholder="Détaillez les étapes clés..."
                            class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Statut</label>
                        <x-ui.select name="status" x-model="currentGoal.status" placeholder="Sélectionner un statut"
                            dropdown-z-index="z-[70]">
                            <option value="todo">À faire</option>
                            <option value="in_progress">En cours</option>
                            <option value="completed">Terminé</option>
                        </x-ui.select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Image
                            d'illustration</label>
                        <div class="relative group">
                            <label class="block cursor-pointer">
                                <div
                                    class="flex flex-col items-center justify-center py-4 px-3 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50 hover:bg-white hover:border-blue-400 transition-all group-hover:shadow-sm">
                                    <div x-show="previewImageUrl || (currentGoal.image && !previewImageUrl)"
                                        class="mb-2">
                                        <img :src="previewImageUrl || '/storage/' + currentGoal.image"
                                            class="w-12 h-12 rounded-lg object-cover ring-1 ring-slate-200">
                                    </div>
                                    <div x-show="!previewImageUrl && !currentGoal.image" class="text-center">
                                        <i data-lucide="upload-cloud"
                                            class="w-6 h-6 text-slate-400 mx-auto mb-1 group-hover:text-blue-500 transition-colors"></i>
                                        <span class="text-[10px] font-bold text-slate-500 uppercase">Cliquer pour
                                            choisir</span>
                                    </div>
                                </div>
                                <input type="file" name="image" @change="previewImage" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Catégories
                        associées</label>
                    <div class="grid grid-cols-2 gap-2">
                        <template x-for="category in categories" :key="category.id">
                            <label
                                class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-slate-50 transition-colors">
                                <input type="checkbox" name="category_ids[]" :value="category.id"
                                    :checked="currentGoal.categories && currentGoal.categories.some(c => c.id === category.id)"
                                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-700" x-text="category.name"></span>
                            </label>
                        </template>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <button type="button" @click="closeModal()"
                        class="px-6 py-3 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-6 py-3 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
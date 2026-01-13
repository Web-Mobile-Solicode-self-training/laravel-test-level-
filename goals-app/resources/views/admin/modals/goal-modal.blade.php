<div id="goal-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto bg-slate-900/40 backdrop-blur-sm p-4 transition-all duration-300">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all border border-slate-200 animate-in zoom-in-95 duration-200">
            
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <div>
                    <h3 id="modal-title" class="text-xl font-bold text-slate-900">Nouveau Goal</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Remplissez les informations ci-dessous.</p>
                </div>
                <button onclick="closeModal()" class="p-2 rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="goal-form" onsubmit="submitForm(event)" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="id" id="goal_id">

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Titre de l'objectif</label>
                        <input type="text" name="title" id="form-title" placeholder="Ex: Maîtriser l'architecture Laravel" 
                               class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Description</label>
                        <textarea name="description" id="form-description" rows="3" placeholder="Détaillez les étapes clés..."
                                  class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Statut</label>
                        <select name="status" id="form-status" class="w-full bg-slate-50 border-slate-200 rounded-xl p-3 text-sm border outline-none focus:border-blue-500 transition-all cursor-pointer">
                            <option value="todo">À faire</option>
                            <option value="in_progress">En cours</option>
                            <option value="completed">Terminé</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Image d'illustration</label>
                        <div class="relative">
                            <input type="file" name="image" id="form-image" 
                                   class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Catégories associées</label>
                    <div class="grid grid-cols-2 gap-3 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                        @foreach($categories as $category)
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-white hover:shadow-sm transition-all border border-transparent hover:border-slate-200">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" 
                                   class="cat-checkbox w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-slate-600 group-hover:text-blue-600 transition-colors">{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <button type="button" onclick="closeModal()" 
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
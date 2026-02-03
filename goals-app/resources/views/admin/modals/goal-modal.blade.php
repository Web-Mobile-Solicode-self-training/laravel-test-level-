<div id="goal-modal"
    class="fixed inset-0 z-[60] hidden overflow-y-auto bg-slate-900/40 backdrop-blur-sm p-4 transition-all duration-300">
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all border border-slate-200 animate-in zoom-in-95 duration-200">

            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <div>
                    <h3 id="modal-title" class="text-xl font-bold text-slate-900">Nouveau Goal</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Remplissez les informations ci-dessous.</p>
                </div>
                <button onclick="closeModal()"
                    class="p-2 rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="goal-form" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="id" id="goal_id">

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Titre de
                            l'objectif</label>
                        <input type="text" name="title" id="form-title"
                            placeholder="Ex: Maîtriser l'architecture Laravel"
                            class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400"
                            required>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Description</label>
                        <textarea name="description" id="form-description" rows="3"
                            placeholder="Détaillez les étapes clés..."
                            class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Statut</label>
                        <select name="status" id="form-status" data-hs-select='{
                                "placeholder": "Choisir un statut...",
                                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-slate-200 rounded-xl text-start text-sm focus:ring-2 focus:ring-blue-500 transition-all outline-none",
                                "dropdownClasses": "mt-2 z-[70] w-full max-h-72 p-1 space-y-0.5 bg-white border border-slate-200 rounded-xl overflow-hidden overflow-y-auto",
                                "optionClasses": "py-2 px-4 w-full text-sm text-slate-800 cursor-pointer hover:bg-slate-100 rounded-lg focus:outline-none focus:bg-slate-100",
                                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><i data-lucide=\"check\" class=\"w-4 h-4 text-blue-600\"></i></span></div>"
                            }' class="hidden">
                            <option value="todo">À faire</option>
                            <option value="in_progress">En cours</option>
                            <option value="completed">Terminé</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Image
                            d'illustration</label>
                        <div class="relative group">
                            <label for="form-image" class="block cursor-pointer">
                                <div
                                    class="flex flex-col items-center justify-center py-4 px-3 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50 hover:bg-white hover:border-blue-400 transition-all group-hover:shadow-sm">
                                    <div id="image-preview-container" class="hidden mb-2">
                                        <img id="image-preview" src="#"
                                            class="w-12 h-12 rounded-lg object-cover ring-1 ring-slate-200">
                                    </div>
                                    <div id="upload-placeholder" class="text-center">
                                        <i data-lucide="upload-cloud"
                                            class="w-6 h-6 text-slate-400 mx-auto mb-1 group-hover:text-blue-500 transition-colors"></i>
                                        <span class="text-[10px] font-bold text-slate-500 uppercase">Cliquer pour
                                            choisir</span>
                                    </div>
                                </div>
                                <input type="file" name="image" id="form-image" class="hidden"
                                    onchange="previewImage(this)">
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Catégories
                        associées</label>
                    <select name="category_ids[]" id="form-categories" multiple data-hs-select='{
                            "placeholder": "Choisir des catégories...",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-slate-200 rounded-xl text-start text-sm focus:ring-2 focus:ring-blue-500 transition-all outline-none",
                            "dropdownClasses": "mt-2 z-[70] w-full max-h-72 p-1 space-y-0.5 bg-white border border-slate-200 rounded-xl overflow-hidden overflow-y-auto",
                            "optionClasses": "py-2 px-4 w-full text-sm text-slate-800 cursor-pointer hover:bg-slate-100 rounded-lg focus:outline-none focus:bg-slate-100",
                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><i data-lucide=\"check\" class=\"w-4 h-4 text-blue-600\"></i></span></div>"
                        }' class="hidden">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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
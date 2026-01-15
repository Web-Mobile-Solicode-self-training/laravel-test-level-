<div id="hs-goal-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
    <form id="goal-form" action="{{ route('admin.goals.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col bg-white border shadow-sm rounded-2xl">
      @csrf
      <input type="hidden" name="goal_id" id="form-goal-id">
      
      <div class="p-4 border-b flex justify-between items-center">
        <h3 class="font-bold text-slate-800" id="modal-title">Nouvel Objectif</h3>
        <button type="button" class="text-slate-400" data-hs-overlay="#hs-goal-modal"><i data-lucide="x"></i></button>
      </div>

      <div class="p-6 space-y-4">
        <div>
            <label class="block text-sm font-medium mb-1">Titre de l'objectif</label>
            <input type="text" name="title" id="form-title" class="py-2 px-3 block w-full border-gray-200 border rounded-lg text-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" id="form-description" class="py-2 px-3 block w-full border-gray-200 border rounded-lg text-sm" rows="3"></textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" id="form-status" class="py-2 px-3 block w-full border-gray-200 border rounded-lg text-sm">
                    <option value="todo">À faire</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminé</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Progrès (%)</label>
                <input type="number" name="progress" id="form-progress" class="py-2 px-3 block w-full border-gray-200 border rounded-lg text-sm">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Catégories</label>
            <div class="flex flex-wrap gap-2">
                @foreach($categories as $cat)
                    <label class="inline-flex items-center gap-x-2 text-xs bg-slate-50 p-2 rounded-lg border border-slate-100 cursor-pointer hover:bg-slate-100">
                        <input type="checkbox" name="category_ids[]" value="{{ $cat->id }}" class="category-checkbox rounded text-blue-600">
                        {{ $cat->name }}
                    </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Image</label>
            <input type="file" name="image" class="block w-full text-sm text-slate-500 file:bg-blue-600 file:text-white file:border-0 file:rounded-lg file:px-4 file:py-2">
        </div>
      </div>

      <div class="p-4 border-t flex justify-end gap-x-2">
        <button type="submit" class="py-2.5 px-4 bg-blue-600 text-white font-semibold rounded-lg text-sm shadow-blue-200 shadow-lg">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

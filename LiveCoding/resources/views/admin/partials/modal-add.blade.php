<div id="hs-modal-add-goal" class="hidden fixed inset-0 z-[100] overflow-y-auto">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden transform transition-all">
            {{-- Header --}}
            <div class="flex justify-between items-center py-4 px-6 border-b border-gray-100 bg-white">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">{{ __('messages.modal.title') }}</h3>
                    <p class="text-sm text-gray-400 mt-0.5">{{ __('messages.modal.subtitle') }}</p>
                </div>
                <button type="button" onclick="closeModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-full hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form id="form-add-goal" action="{{ route('admin.goals.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-6">
                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('messages.modal.form.title') }}</label>
                        <input type="text" name="title" placeholder="{{ __('messages.modal.form.title_placeholder') }}"
                            class="w-full border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 focus:bg-white transition-colors"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('messages.modal.form.description') }}</label>
                            <textarea name="description" rows="4" placeholder="{{ __('messages.modal.form.description_placeholder') }}"
                                class="w-full border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 focus:bg-white transition-colors resize-none"></textarea>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('messages.modal.form.status') }}</label>
                            <div class="relative">
                                <select name="status"
                                    class="w-full border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 focus:bg-white appearance-none cursor-pointer">
                                    <option value="todo">{{ __('messages.modal.status_options.todo') }}</option>
                                    <option value="in_progress">{{ __('messages.modal.status_options.in_progress') }}</option>
                                    <option value="completed">{{ __('messages.modal.status_options.completed') }}</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.modal.form.categories') }}</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                        class="peer sr-only">
                                    <span
                                        class="inline-block px-3 py-1.5 rounded-lg text-xs font-medium border border-gray-200 text-gray-500 bg-white hover:bg-gray-50 peer-checked:bg-blue-50 peer-checked:text-blue-600 peer-checked:border-blue-200 transition-all select-none">
                                        {{ $category->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- File Input --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.modal.form.cover_image') }}</label>
                        <label
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-white hover:border-blue-400 transition-all group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <p class="mb-1 text-sm text-gray-500"><span class="font-semibold text-blue-600">{{ __('messages.modal.form.upload_text') }}</span></p>
                                <p class="text-xs text-gray-400">{{ __('messages.modal.form.upload_hint') }}</p>
                            </div>
                            <input type="file" name="image" class="hidden">
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <button type="button" onclick="closeModal()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all shadow-sm">
                        {{ __('messages.buttons.cancel') }}
                    </button>
                    <button type="submit" id="submit-btn"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all shadow-md shadow-blue-500/20">
                        {{ __('messages.buttons.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
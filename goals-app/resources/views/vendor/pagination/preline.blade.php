@if ($paginator->hasPages())
    <nav class="flex items-center justify-center -space-x-px" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button type="button"
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-s-xl text-slate-400 bg-white border border-slate-200 cursor-default disabled:opacity-50"
                disabled>
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span class="hidden sm:block">Précédent</span>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-s-xl text-slate-800 bg-white border border-slate-200 hover:bg-slate-50 focus:outline-none focus:bg-slate-50 transition-colors"
                aria-label="Previous">
                <i data-lucide="chevron-left" class="w-4 h-4 text-blue-600"></i>
                <span class="hidden sm:block">Précédent</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center -space-x-px">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span
                        class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-slate-200 bg-white text-slate-400 py-2 px-3 text-sm">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button type="button"
                                class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-blue-600 text-white border border-blue-600 py-2 px-3 text-sm font-bold focus:outline-none focus:bg-blue-700"
                                aria-current="page">
                                {{ $page }}
                            </button>
                        @else
                            <a href="{{ $url }}"
                                class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-white text-slate-800 border border-slate-200 hover:bg-slate-50 py-2 px-3 text-sm focus:outline-none transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-e-xl text-slate-800 bg-white border border-slate-200 hover:bg-slate-50 focus:outline-none focus:bg-slate-50 transition-colors"
                aria-label="Next">
                <span class="hidden sm:block">Suivant</span>
                <i data-lucide="chevron-right" class="w-4 h-4 text-blue-600"></i>
            </a>
        @else
            <button type="button"
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-e-xl text-slate-400 bg-white border border-slate-200 cursor-default disabled:opacity-50"
                disabled>
                <span class="hidden sm:block">Suivant</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>
        @endif
    </nav>
@endif
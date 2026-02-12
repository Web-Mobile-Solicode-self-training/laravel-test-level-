@props(['goal'])

<div
    class="group flex flex-col h-full bg-white border border-slate-200 shadow-sm rounded-3xl transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-1 overflow-hidden">
    <div class="relative aspect-[16/10] overflow-hidden">
        <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out"
            src="{{ $goal->image ? asset('storage/' . $goal->image) : 'https://placehold.co/600x400?text=Objectif' }}"
            alt="{{ $goal->title }}">

        <div
            class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>

        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
            @foreach($goal->categories as $category)
                <span
                    class="inline-flex items-center py-1 px-2.5 rounded-lg text-[10px] font-black bg-white/95 text-slate-800 shadow-sm backdrop-blur-md uppercase tracking-wider">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>

        <div class="absolute bottom-4 right-4">
            <x-ui.status-pill :status="$goal->status" />
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">
            {{ $goal->title }}
        </h3>
        <p class="mt-3 text-slate-500 line-clamp-3 text-sm leading-relaxed">
            {{ $goal->description }}
        </p>
    </div>

    <div class="mt-auto p-6 pt-0">
        <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl bg-slate-50 text-slate-800 border border-slate-200 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-300 group/btn"
            href="{{ route('show', $goal->id) }}">
            Consulter le projet
            <i data-lucide="arrow-right"
                class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
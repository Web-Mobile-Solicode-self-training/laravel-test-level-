@extends('layouts.public')

@section('content')
<div class="bg-gradient-to-b from-slate-50 to-white min-h-screen">
    <div class="max-w-[85rem] px-4 py-12 sm:px-6 lg:px-8 lg:py-20 mx-auto">
        
        <div class="max-w-3xl mb-12">
            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-4">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                Saison 2026
            </span>
            <h2 class="text-3xl font-black md:text-5xl text-slate-900 tracking-tight">
                Découvrez les <span class="text-blue-600">Objectifs</span>
            </h2>
            <p class="mt-4 text-lg text-slate-600 leading-relaxed">
                Explorez les défis technologiques et les projets personnels prévus pour cette année. Chaque carte représente une étape vers l'excellence.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($goals as $goal)
            <div class="group flex flex-col h-full bg-white border border-slate-200 shadow-sm rounded-3xl transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-1 overflow-hidden">
                
                <div class="relative aspect-[16/10] overflow-hidden">
                    <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out" 
                         src="{{ $goal->image ? asset('storage/' . $goal->image) : 'https://placehold.co/600x400?text=Objectif' }}" 
                         alt="{{ $goal->title }}">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                        @foreach($goal->categories as $category)
                        <span class="inline-flex items-center py-1 px-2.5 rounded-lg text-[10px] font-black bg-white/95 text-slate-800 shadow-sm backdrop-blur-md uppercase tracking-wider">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>

                    <div class="absolute bottom-4 right-4">
                        @php
                            $statusColors = [
                                'todo' => 'bg-slate-900',
                                'in_progress' => 'bg-blue-600',
                                'completed' => 'bg-emerald-500',
                            ];
                            $bgColor = $statusColors[$goal->status] ?? 'bg-slate-900';
                        @endphp
                        <span class="{{ $bgColor }} text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase shadow-lg">
                            {{ str_replace('_', ' ', $goal->status) }}
                        </span>
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
                        <i data-lucide="arrow-right" class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
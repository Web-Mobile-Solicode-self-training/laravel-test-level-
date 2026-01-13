@extends('layouts.public')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <a href="{{ route('index') }}" class="inline-flex items-center text-sm text-slate-400 hover:text-blue-600 mb-10 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
        Retour à la galerie
    </a>

    <div class="grid lg:grid-cols-12 gap-12 items-start">
        <div class="lg:col-span-7">
            <div class="overflow-hidden rounded-2xl shadow-sm border border-slate-100 bg-white">
                <img class="w-full h-auto object-cover" 
                     src="{{ $goal->image ? asset('storage/' . $goal->image) : 'https://placehold.co/800x600?text=Mon+Objectif' }}" 
                     alt="{{ $goal->title }}">
            </div>
        </div>

        <div class="lg:col-span-5 space-y-8">
            <div>
                <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                    {{ str_replace('_', ' ', $goal->status) }}
                </span>
                
                <h1 class="text-4xl font-bold text-slate-900 mt-4 leading-tight">
                    {{ $goal->title }}
                </h1>

                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($goal->categories as $cat)
                    <span class="text-sm text-slate-400 font-medium italic">#{{ $cat->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8">
                <p class="text-lg text-slate-600 leading-relaxed">
                    {{ $goal->description }}
                </p>
            </div>

            <div class="pt-6 flex items-center gap-6 text-slate-400">
                <div class="flex items-center gap-2 text-xs">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Ajouté le {{ $goal->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
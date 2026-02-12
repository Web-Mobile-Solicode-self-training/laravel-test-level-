@extends('layouts.public')

@section('content')
    <div class="bg-gradient-to-b from-slate-50 to-white min-h-screen">
        <div class="max-w-[85rem] px-4 py-12 sm:px-6 lg:px-8 lg:py-20 mx-auto">

            <x-public.hero />

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($goals as $goal)
                    <x-public.goal-card :goal="$goal" />
                @endforeach
            </div>

            <div class="mt-12 border-t border-slate-100 pt-8 flex justify-center">
                {{ $goals->links('vendor.pagination.preline') }}
            </div>
        </div>
    </div>
@endsection
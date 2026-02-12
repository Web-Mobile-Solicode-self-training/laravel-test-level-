@extends('layouts.public')

@section('content')
    <div x-data="goalManager({ 
                                        goals: {{ $goals->getCollection()->toJson() }}, 
                                        categories: {{ $categories->toJson() }},
                                        saveRoute: '{{ route('admin.save') }}'
                                    })" class="max-w-[85rem] px-4 py-8 mx-auto">

        <!-- Header -->
        <x-admin.header />

        <!-- Filters -->
        <x-admin.filters />

        <!-- Table -->
        <x-admin.table />

        <div class="mt-8 border-t border-slate-100 pt-6">
            {{ $goals->links('vendor.pagination.preline') }}
        </div>
        @include('admin.modals.goal-modal')
    </div>
@endsection
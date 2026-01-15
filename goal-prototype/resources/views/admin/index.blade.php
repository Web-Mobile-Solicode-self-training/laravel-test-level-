@extends('layouts.admin')

@section('content')
    <div class="p-6 space-y-6">
        <div class="flex justify-between items-center bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ __('messages.management') }}</h1>
                <p class="text-sm text-gray-500">{{ __('messages.subtitle') }}</p>
            </div>
            <button type="button" onclick="openModal()"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                <i data-lucide="plus" class="w-4 h-4"></i> {{ __('messages.create_article') }}
            </button>
        </div>

        <div class="max-w-md">
            <div class="relative">
                <input type="text" id="ajax-search" data-url="{{ route('admin.goals.index') }}"
                    class="py-2 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm"
                    placeholder="{{ __('messages.search_placeholder') }}">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">{{ __('messages.columns.image') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">{{ __('messages.columns.details') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">{{ __('messages.columns.categories') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">{{ __('messages.columns.description') }}</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="divide-y divide-gray-200">
                    @include('admin.partials.table')
                </tbody>
            </table>
        </div>
    </div>

    {{-- Partials --}}
    @include('admin.partials.modal-add')

    @push('scripts')
        @vite(['resources/js/admin-goals.js'])
    @endpush
@endsection
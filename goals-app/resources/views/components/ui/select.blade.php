@props([
    'name' => null,
    'xModel' => null,
    'placeholder' => 'Sélectionner...',
    'options' => [], // Format: ['value' => 'Label']
    'dropdownZIndex' => 'z-50'
])
<div class="relative">
    <select 
        @if($name) name="{{ $name }}" @endif
        @if($xModel) x-model="{{ $xModel }}" @endif
        data-hs-select='{
            "placeholder": "{{ $placeholder }}",
            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-slate-200 rounded-xl text-sm text-start focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500",
            "dropdownClasses": "mt-2 {{ $dropdownZIndex }} w-full max-h-72 p-1 space-y-0.5 bg-white border border-slate-200 rounded-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-100 [&::-webkit-scrollbar-thumb]:bg-slate-300",
            "optionClasses": "py-2 px-4 w-full text-sm text-slate-800 cursor-pointer hover:bg-slate-100 rounded-lg focus:outline-none focus:bg-slate-100",
            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span><span data-title></span></span><span class=\"hidden hs-selected:block\"><i data-lucide=\"check\" class=\"shrink-0 size-3.5 text-blue-600\"></i></span></div>"
        }' class="hidden">
        <option value="">{{ $placeholder }}</option>
        {{ $slot }}
    </select>

    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
        <i data-lucide="chevron-down" class="shrink-0 size-3.5 text-slate-500"></i>
    </div>
</div>

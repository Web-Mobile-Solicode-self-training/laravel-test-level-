@foreach($goals as $goal)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4">
            @if($goal->image)
                <img src="{{ asset('storage/' . $goal->image) }}" class="w-10 h-10 rounded object-cover">
            @else
                <div class="w-10 h-10 bg-gray-100 flex items-center justify-center">?</div>
            @endif
        </td>
        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $goal->title }}</td>
        <td class="px-6 py-4">
            @foreach($goal->categories as $cat)
                <span class="text-[10px] bg-blue-100 text-blue-700 px-1 rounded">{{ $cat->name }}</span>
            @endforeach
        </td>
        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $goal->description }}</td>
    <td class="px-6 py-4 text-end">
        <button onclick="deleteGoal('{{ route('admin.goals.destroy', $goal->id) }}', '{{ __('messages.confirm_delete') }}')" class="text-red-600 text-sm hover:underline">{{ __('messages.buttons.delete') }}</button>
    </td>
@endforeach
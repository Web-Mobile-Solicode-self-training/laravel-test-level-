@foreach($goals as $goal)
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <img src="{{ $goal->image ? asset('storage/' . $goal->image) : 'https://placehold.co/50x50' }}" class="w-10 h-10 rounded-lg object-cover">
    </td>
    <td class="px-6 py-4">
        <div class="text-sm font-bold text-slate-800">{{ $goal->title }}</div>
        <div class="flex gap-1 mt-1">
            @foreach($goal->categories as $cat)
                <span class="text-[10px] bg-slate-100 text-slate-600 px-1.5 rounded">#{{ $cat->name }}</span>
            @endforeach
        </div>
    </td>
    <td class="px-6 py-4">
        <span class="px-2 py-1 rounded-full text-[10px] font-bold text-white 
            {{ $goal->status == 'completed' ? 'bg-emerald-500' : ($goal->status == 'in_progress' ? 'bg-blue-500' : 'bg-slate-400') }}">
            {{ strtoupper(str_replace('_', ' ', $goal->status)) }}
        </span>
    </td>
    <td class="px-6 py-4">
        <div class="w-full bg-gray-200 rounded-full h-1.5 max-w-[100px]">
            <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $goal->progress }}%"></div>
        </div>
        <span class="text-[10px] text-slate-500">{{ $goal->progress }}%</span>
    </td>
    <td class="px-6 py-4 text-end space-x-3">
        <button onclick="editGoal('{{ route('admin.goals.edit', $goal->id) }}')" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Editer</button>
        <button onclick="deleteGoal('{{ route('admin.goals.destroy', $goal->id) }}')" class="text-red-600 hover:text-red-800 font-medium text-sm">Supprimer</button>
    </td>
</tr>
@endforeach
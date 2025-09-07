<div
    x-data=""
    class="border border-indigo-100 p-2 rounded-md"
    id="column-{{$this->state}}"
    @dragover="$event.preventDefault()"
    @drop="$wire.insertTask(parseInt($event.dataTransfer.getData('taskId')))"
>
    
    <div class="text-xl font-bold text-center bg-slate-300 rounded-md p-1">
        {{ $this->stateName }}
    </div>

    <br>

    <div class="flex gap-3 flex-col">
        @foreach ( $tasks as $task )
        <div 
            class="border border-black-100 w-full p-1 cursor-pointer bg-white rounded-md draggable-task" 
            draggable="true"
            wire:key="task-{{ $task->id }}"
            data-task="{{ $task->id }}"
            ondragstart="event.dataTransfer.setData('taskId', '{{ $task->id }}')"
        >
            {{ $task->title }}
            <div class="text-right">
                <x-primary-button
                    type="button"
                    {{-- @click="$dispatch('open-edit-modal', { taskId: {{ $task->id }} })" --}}
                    onclick="window.dispatchEvent(new CustomEvent('open-edit-modal', { detail: { taskId: {{ $task->id }} } }))"
                >
                    Editar
                </x-primary-button>
            </div>
        </div>
        @endforeach
    </div>

</div>
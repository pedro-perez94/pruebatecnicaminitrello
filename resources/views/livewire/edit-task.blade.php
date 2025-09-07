<!-- Modal Nueva/Editar Tarea -->
<div 
    x-data="{ open: @entangle('showModal') }" 
    x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
    x-show="open"
    x-transition.opacity
    @open-edit-modal.window="taskId = $event.detail.taskId;$wire.loadTask(taskId)"
>
    <div 
        class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative"
        @keydown.escape.window="open = false"
    >
        <!-- Botón cerrar -->
        <button 
            type="button" 
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
            @click="open = false"
        >
            ✕
        </button>

        <!-- Título -->
        <h2 class="text-xl font-semibold text-gray-700 mb-4">
            Editar tarea
        </h2>

        <!-- Formulario -->
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Input Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-600 mb-1">Título</label>
                <input type="text" 
                    id="title" 
                    wire:model.defer="task.title"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
            </div>

            <!-- Select Estado -->
            <div>
                <label for="state" class="block text-sm font-medium text-gray-600 mb-1">Estado</label>
                <select 
                    id="state" 
                    wire:model.defer="task.state"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    <option value="">Seleccione estado</option>
                    @foreach ( \App\Enum\StatesEnum::getForOptions() as $key => $state )
                        <option value="{{ $key }}">{{ $state }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Textarea Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Descripción</label>
                <textarea 
                    id="description" 
                    rows="4" 
                    wire:model.defer="task.description"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                ></textarea>
            </div>

            <!-- Botón Guardar -->
            <div class="pt-2">
                <x-ui.button.livewire-loading type="button" wire:click="save" wire:target="save">
                    Actualizar
                </x-ui.button.livewire-loading>
            </div>
        </form>
    </div>
</div>
